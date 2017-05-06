<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AdminPermissionCreateRequest extends FormRequest
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
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->input('permission');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required|max:255',
            'label'=>'required|max:255',
            'cid'=>'integer',
            'uri'=>'required',
        ];
        $data = $this->validationData();
        if((!isset($data['type']) || empty($data['type'])) && !$data['cid']){
            unset($rules['uri']);
        }
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'=>'权限规则',
            'label'=>'权限名称',
            'uri'=>'路由地址',
        ];
    }
}
