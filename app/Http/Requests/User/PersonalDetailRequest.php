<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDetailRequest extends FormRequest
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
            'first_name'=>'required|max:255',
            'middle_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'address'=>'required',
            'gender'=>'required|integer',
            'country_id'=>'required|exists:countries,id',
            'state_id'=>'required|exists:states,id',
            'city_id'=>'required|exists:cities,id',
            'dob'=>'required|date|before:-18 years',
            'birth_time'=>'',
            'height'=>'required|integer',
            'weight'=>'required|integer',
            'marital_status'=>'required|integer',
            'fitness'=>'required|integer',
            'skin'=>'required|integer',
            'contact'=>'required|array',
            'blood_group'=>'max:5',
            'mother_tongue'=>'required|max:255',
            'physical_handicape'=>'required|boolean',
            'physical_handicape_detail'=>'max:255',
            'addiction'=>'array',
            'diet'=>'required|integer',
            'family_diet'=>'max:255'
        ];
    }
}
