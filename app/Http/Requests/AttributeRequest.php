<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|unique:attributes,name'
        ];

        if($this->method() == 'PUT') {
            $rules['name'] = 'required|string|unique:attributes,name,' . $this->route('id');
        }

        return $rules;
    }
}
