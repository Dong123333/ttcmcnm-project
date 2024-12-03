<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\Web\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'code_id' => 'required|uuid|exists:users,code_id',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu.',
            'password_confirmation.min' => 'Mật khẩu nhập lại phải có ít nhất 6 ký tự.',
            'code_id.required' => 'Mã xác nhận là bắt buộc.',
            'code_id.uuid' => 'Mã xác nhận phải là một UUID hợp lệ.',
            'code_id.exists' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn.',
        ];
    }
}

