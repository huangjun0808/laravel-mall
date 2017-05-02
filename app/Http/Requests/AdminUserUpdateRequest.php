<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
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

    protected function validationData()
    {
        return $this->input('user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'email'  => 'required|email|max:255',
            'password'  => 'confirmed|min:6|max:50',
        ];
    }

    public function attributes()
    {
        return [
            'name'  => '用户名',
            'email'  => '邮箱',
            'password'  => '密码',
        ];
    }


}
