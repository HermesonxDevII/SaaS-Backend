<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{ Validator, Log };
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller {
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('active', true)
            ],
            'company_segment_id' => [
                'required',
                'integer',
                Rule::exists('companies_segments', 'id')->where('active', true)
            ],
            'company_group_id' => [
                'nullable',
                'integer',
                Rule::exists('companies_groups', 'id')->where('active', true)
            ],
            'corporate_reason' => 'required|string',
            'cpf_cnpj'         => 'required|string',
            'fantasy_name'     => 'required|string',
            'street'           => 'nullable|string',
            'number'           => 'nullable|string',
            'neighborhood'     => 'nullable|string',
            'city'             => 'nullable|string',
            'state'            => 'nullable|string',
            'postal_code'      => 'nullable|string',
            'latitude'         => 'nullable|string',
            'longitude'        => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on creating company.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            Company::create([
                'user_id'            => $request->user_id,
                'corporate_reason'   => $request->corporate_reason,
                'fantasy_name'       => $request->fantasy_name,
                'cpf_cnpj'           => $request->cpf_cnpj,
                'street'             => $request->street,
                'number'             => $request->number,
                'neighborhood'       => $request->neighborhood,
                'city'               => $request->city,
                'state'              => $request->state,
                'postal_code'        => $request->postal_code,
                'company_segment_id' => $request->company_segment_id,
                'company_group_id'   => $request->company_group_id,
                'latitude'           => $request->latitude,
                'longitude'          => $request->longitude,
            ]);

            return response()->json([
                'message' => 'Company created has successfully!'
            ], 201, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on creating company.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function list(Request $request) {
        try {
            $filters = [
                'id'                 => $request->query('id'),
                'user_id'            => $request->query('user_id'),
                'cpf_cnpj'           => $request->query('cpf_cnpj'),
                'company_segment_id' => $request->query('company_segment_id'),
                'company_group_id'   => $request->query('company_group_id'),
                'active'             => $request->query('active'),
                'limit'              => $request->query('limit')
            ];

            $query = Company::query()->where('deleted', '<>', true);

            foreach ($filters as $filter => $value) {
                if (!is_null($value)) {
                    switch ($filter) {
                        case 'id':
                        case 'user_id':
                        case 'company_segment_id':
                        case 'company_group_id':
                            $query->where($filter, (int) $value);
                            break;
                        case 'cpf_cnpj':
                            $query->where($filter, (string) $value);
                            break;
                        case 'active':
                            $query->where($filter, filter_var($value, FILTER_VALIDATE_BOOLEAN));
                            break;
                        case 'limit':
                            $query->limit((int) $value);
                    }
                }
            }

            $companies = $query->get();

            if ($companies->isEmpty()) {
                return response()->json([
                    'message' => 'Error on listing company(ies).',
                    'errors'  => 'Company(ies) not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            return response()->json([
                'limit' => $filters['limit'],
                'total' => $companies->count(),
                'data'  => $companies
            ], 200, [], JSON_UNESCAPED_SLASHES);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on listing company(ies).',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function edit(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'company_segment_id' => [
                'nullable',
                'integer',
                Rule::exists('companies_segments', 'id')->where('active', true)
            ],
            'company_group_id' => [
                'nullable',
                'integer',
                Rule::exists('companies_groups', 'id')->where('active', true)
            ],
            'corporate_reason' => 'nullable|string',
            'cpf_cnpj'         => 'nullable|string',
            'fantasy_name'     => 'nullable|string',
            'street'           => 'nullable|string',
            'number'           => 'nullable|string',
            'neighborhood'     => 'nullable|string',
            'city'             => 'nullable|string',
            'state'            => 'nullable|string',
            'postal_code'      => 'nullable|string',
            'latitude'         => 'nullable|string',
            'longitude'        => 'nullable|string',
            'active'           => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on editing company.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_JSON);
        }

        try {

            $company = Company::where('id', $id)->first();

            if (!$company) {
                return response()->json([
                    'message' => 'Error on editing company.',
                    'errors'  => 'Company not found.'
                ]);
            }

            $company->corporate_reason = $request->corporate_reason;
            $company->fantasy_name = $request->fantasy_name;
            $company->cpf_cnpj = $request->cpf_cnpj;
            $company->street = $request->street;
            $company->number = $request->number;
            $company->neighborhood = $request->neighborhood;
            $company->city = $request->city;
            $company->state = $request->state;
            $company->postal_code = $request->postal_code;
            $company->company_segment_id = $request->company_segment_id;
            $company->company_group_id = $request->company_group_id;
            $company->latitude = $request->latitude;
            $company->longitude = $request->longitude;
            $company->active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            $company->save();

            return response()->json([
                'message' => 'Company edited has successfully!',
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on editing company.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function delete(Request $request, int $id) {
        try {
            $company = Company::where('id', $id)->first();

            if (!$company) {
                return response()->json([
                    'message' => 'Error on deleting company.',
                    'errors'  => 'Company not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $company->deleted = true;
            $company->save();

            return response()->json([
                'message' => 'Company deleted has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on deleting company.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }
}
