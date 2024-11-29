<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\Web\BaseRequest;

class HomeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function authorize()
    {
        // Nếu cần kiểm tra quyền người dùng, trả về true để cho phép yêu cầu
        return true;
    }
    
    public function rules()
    {
        return [
            'fullName' => 'nullable|string|max:255',
            'nickName' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

}
