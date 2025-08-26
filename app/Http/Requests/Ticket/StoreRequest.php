<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'title'             => 'required|string',
            'company'           => [
                'required',
                'integer',
                Rule::exists('companies', 'id')
            ],
            'description'       => 'nullable|string',
            'solicitation_type' => [
                'required',
                'integer',
                Rule::exists('solicitation_types', 'id')
            ],
            'responsible_team'  => [
                'required',
                'integer',
                Rule::exists('responsible_teams', 'id')
            ],
            'priority'          => [
                'required',
                'integer',
                Rule::exists('priorities', 'id')
            ],
            'attachments'       => 'nullable|array|max:5',
            'attachments.*'     => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ];
    }
}
