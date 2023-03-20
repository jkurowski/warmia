<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostEventRequest extends FormRequest
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
            'name' => 'required',
            'start' => 'required|date|date_format:Y-m-d',
            'time' => 'nullable|date_format:H:i',
            'client_id' => 'nullable|integer',
            'user_id' => 'nullable|integer|exists:users,id',
            'type' => 'required|integer',
            'note' => '',
            'active' => 'boolean',
            'allday' => 'boolean'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Wpisz <b>nazwę</b> wydarzenia',
            'start.required' => 'Pole <b>data</b> jest wymagane',
            'start.date_format' => 'Zły format daty w polu <b>Data</b>'
        ];
    }
}
