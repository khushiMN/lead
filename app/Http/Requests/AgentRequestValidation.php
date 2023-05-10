<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequestValidation extends FormRequest
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
            //
            'name'=>'required|regex:/^([a-zA-Z ]*)$/|max:50',
            'phone_no'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'',
            'email'=>'required|unique:users,email',
            'password'=>'required|regex:/^([a-zA-Z0-9]*)$/|min:8',
        ];
    }
}
