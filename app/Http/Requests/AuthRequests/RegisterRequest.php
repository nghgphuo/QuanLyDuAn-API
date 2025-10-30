<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|in:admin,user',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.string' => 'Tên người dùng phải là chuỗi ký tự.',
            'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã được đăng ký.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'role.in' => 'Vai trò không hợp lệ. Chỉ được phép: admin hoặc user.',
      
        ];
    }
}