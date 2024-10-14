<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VaccineRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($this->id, 'id')
            ],
            'nid' => [
                'required',
                'digits_between:10,20',
                Rule::unique('vaccine_register')->ignore($this->id, 'id')
            ],
            'center_id' => 'required|exists:vaccine_center,id',
        ];
    }
}
