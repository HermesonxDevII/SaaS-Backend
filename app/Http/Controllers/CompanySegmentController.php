<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\CompanySegment;
use Illuminate\Http\Request;

class CompanySegmentController extends Controller {
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('active', true)
            ],
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on creating company segment.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            CompanySegment::create([
                'user_id' => $request->user_id,
                'name'    => $request->name
            ]);

            return response()->json([
                'message' => 'Company segment created has successfully!'
            ], 201, [], JSON_UNESCAPED_SLASHES);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on creating company segment.'
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function list(Request $request) {
        try {
            $filters = [
                'id'      => $request->query('id'),
                'user_id' => $request->query('user_id'),
                'name'    => $request->query('name'),
                'active'  => $request->query('active'),
                'limit'   => $request->query('limit')
            ];

            $query = CompanySegment::query()->where('deleted', '<>', true);

            foreach ($filters as $filter => $value) {
                if (!is_null($value)) {
                    switch ($filter) {
                        case 'id':
                        case 'user_id':
                            $query->where($filter, (int) $value);
                            break;
                        case 'name':
                            $query->where($filter, (string) $value);
                            break;
                        case 'active':
                            $query->where($filter, filter_var($value, FILTER_VALIDATE_BOOLEAN));
                            break;
                        case 'limit':
                            $query->limit((int) $value);
                            break;
                    }
                }
            }

            $companiesSegments = $query->get();

            if ($companiesSegments->isEmpty()) {
                return response()->json([
                    'message' => 'Error on listing companies segments',
                    'errors'  => 'Company(ies) segment(s) not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            return response()->json([
                'limit' => $filters['limit'],
                'total' => $companiesSegments->count(),
                'data'  => $companiesSegments
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on listing companies segments',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function edit(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name'   => 'nullable|string',
            'active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on editing company segment.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            $companySegment = CompanySegment::where('id', $id)->first();

            if (!$companySegment) {
                return response()->json([
                    'message' => 'Error on editing company segment.',
                    'errors'  => 'Company Segment not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $companySegment->name = $request->name;
            $companySegment->active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            $companySegment->save();

            return response()->json([
                'message' => 'Company segment edited has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on editing company segment.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function delete(Request $request, int $id) {
        try {
            $companySegment = CompanySegment::where('id', $id)->first();

            if (!$companySegment) {
                return response()->json([
                    'message' => 'Error on deleting company segment.',
                    'errors'  => 'Company segment not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $companySegment->deleted = true;
            $companySegment->save();

            return response()->json([
                'message' => 'Company segment deleted has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on deleting company segment.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }
}
