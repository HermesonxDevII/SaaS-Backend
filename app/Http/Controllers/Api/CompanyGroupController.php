<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{ Validator, Log };
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\CompanyGroup;

class CompanyGroupController extends Controller {
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
                'message' => 'Error on creating company group.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {

            CompanyGroup::create([
                'user_id' => $request->user_id,
                'name'    => $request->name
            ]);

            return response()->json([
                'message' => 'Company group created has successfully!'
            ], 201, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on creating company group.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function list(Request $request) {
        try {
            $filters = [
                'id'      => $request->query('id'),
                'user_id' => $request->query('user_id'),
                'active'  => $request->query('active'),
                'limit'   => $request->query('limit')
            ];

            $query = CompanyGroup::query()->where('deleted', '<>', true);

            foreach ($filters as $filter => $value) {
                if (!is_null($value)) {
                    switch ($filter) {
                        case 'id':
                        case 'user_id':
                            $query->where($filter, (int) $value);
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

            $companiesGroups = $query->get();

            if ($companiesGroups->isEmpty()) {
                return response()->json([
                    'message' => 'Error on listing company(ies) group(s).',
                    'errors'  => 'Company(ies) group(s) not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            return response()->json([
                'limit' => $filters['limit'],
                'total' => $companiesGroups->count(),
                'data'  => $companiesGroups
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on listing company(ies) group(s).',
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
                'message' => 'Error on editing company group.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {

            $companyGroup = CompanyGroup::where('id', $id)->first();

            if (!$companyGroup) {
                return response()->json([
                    'message' => 'Error on editing company group.',
                    'errors'  => 'Company group not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $companyGroup->name = $request->name;
            $companyGroup->active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            $companyGroup->save();

            return response()->json([
                'message' => 'Company group edited has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on editing company group.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function delete(Request $request, int $id) {
        try {
            $companyGroup = CompanyGroup::where('id', $id)->first();

            if (!$companyGroup) {
                return response()->json([
                    'message' => 'Error on deleting company group.',
                    'errors'  => 'Company group not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $companyGroup->deleted = true;
            $companyGroup->save();

            return response()->json([
                'message' => 'Company group deleted has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on deleting company group.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }
}