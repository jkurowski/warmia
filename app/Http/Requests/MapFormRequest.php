<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapFormRequest extends FormRequest
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
        if ($this->request->get('lang')) {
            return [
                'name' => 'required|string|min:5|max:100',
            ];
        } else {
            return [
                'name' => 'required|string|min:5|max:100',
                'group_id' => '',
                'lat' => 'required',
                'lng' => 'required|',
                'zoom' => 'required|integer',
                'address' => 'required|string'
            ];
        }
    }
}
