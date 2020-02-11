<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee.*.firstname' => ['required', 'string'],
            'employee.*.lastname' => ['required', 'string'],
            'employee.*.email' => ['required', 'email'],

            'firstname' => ['string', 'nullable'],
            'lastname' => ['string', 'nullable'],
            'email' => ['unique:employees', 'email', 'nullable'],
        ];
    }
}
