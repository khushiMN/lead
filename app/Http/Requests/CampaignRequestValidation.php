<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequestValidation extends FormRequest
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
            'campaign_name'=>'required|max:100',
            'description'=>'',
            'cost_per_lead'=>'required|regex:/^([0-9.]*)$/',
            'conversion_cost_per_lead'=>'required|regex:/^([0-9.]*)$/',
            // 'user_id[]'=>'required|array|min:1',
        ];
    }
}
