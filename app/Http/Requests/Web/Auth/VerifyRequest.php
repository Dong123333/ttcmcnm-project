<?php

namespace App\Http\Requests\Web\Auth;

use App\Http\Requests\Web\BaseRequest;

class VerifyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'code_id' => 'required|uuid|exists:users,code_id',
        ];
    }

    public function messages()
    {
        return [
            'code_id.required' => 'Mã xác nhận là bắt buộc.',
            'code_id.uuid' => 'Mã xác nhận phải là một UUID hợp lệ.',
            'code_id.exists' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn.',
        ];
    }
}

