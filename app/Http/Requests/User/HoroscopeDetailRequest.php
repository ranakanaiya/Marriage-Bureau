<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class HoroscopeDetailRequest extends FormRequest
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
            'believe_janmaksar' => 'required|integer',
            'janmaksar_type' => 'required|integer',
            'naksatra' => 'required|integer',
            'zodiac_sign' => 'required|integer',
            'gan' => 'required|integer',
            'naadi' => 'required|integer',
        ];
    }
}
