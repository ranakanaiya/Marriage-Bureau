<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FamilyDetailRequest extends FormRequest
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
            'religion'=>'required|max:255',
            'caste'=>'required|max:255',
            'sub_caste'=>'required|max:255',
            'father_name'=>'required|max:255',
            'mother_name'=>'required|max:255',
            'father_occupation'=>'required|max:255',
            'mother_occupation'=>'required|max:255',
            'mosal'=>'required',
            'parental_address'=>'required',
            'family_type'=>'required|integer',
            'brother_name'=>'array',
            'brother_married'=>'array',
            'brother_education'=>'array',
            'sister_name'=>'array',
            'sister_married'=>'array',
            'sister_education'=>'array',
            'property_detail'=>'required|max:255'
        ];
    }
}
