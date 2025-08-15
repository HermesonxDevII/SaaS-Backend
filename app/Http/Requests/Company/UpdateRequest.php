<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'corporate_reason' => 'nullable|string',
            'fantasy_name'     => 'nullable|string',
            'cpf_cnpj'         => 'nullable|string|max:18',
            'company_segment'  => [
                'nullable',
                'string',
                Rule::exists('companies_segments', 'id')
                    ->where('user_id', loggedUser()->id)
            ],
            'company_group'    => [
                'nullable',
                'string',
                Rule::exists('companies_groups', 'id')
                    ->where('user_id', loggedUser()->id)
            ],
            'street'           => 'nullable|string',
            'number'           => 'nullable|string',
            'neighborhood'     => 'nullable|string',
            'postal_code'      => 'nullable|string|max:9',
            'city'             => 'nullable|string',
            'state'            => 'nullable|string',
            'latitude'         => 'nullable|string',
            'longitude'        => 'nullable|string',
            'active'           => 'nullable|boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->boolean('active'),
        ]);
    }
}
