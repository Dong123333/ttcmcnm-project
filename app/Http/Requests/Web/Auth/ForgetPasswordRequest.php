<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\Web\BaseRequest;

class ForgetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại.',
        ];
    }
}

