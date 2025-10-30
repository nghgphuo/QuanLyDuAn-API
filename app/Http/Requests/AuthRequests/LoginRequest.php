<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ];
    }
}