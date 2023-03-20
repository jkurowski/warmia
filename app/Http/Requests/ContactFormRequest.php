<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'form_name' => 'required',
            'form_email' => 'required|email:rfc',
            'form_message' => '',
            'form_phone' => 'required',
            'rule_.*' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'form_name.required' => 'To pole jest wymagane',
            'form_email.required' => 'To pole jest wymagane',
            'form_email.email' => 'Nieprawidłowy adres e-mail',
            'form_phone.required' => 'To pole jest wymagane',
            'rule_.*.required' => 'To pole jest wymagane'
        ];
    }
}
