<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
            'id' => ['required', 'integer', Rule::exists('users', 'id')],
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,',
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|in:admin,user',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID người dùng không được để trống',
            'id.integer' => 'ID phải là số nguyên',
            'id.exists' => 'Người dùng không tồn tại',
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'role.in' => 'Vai trò phải là admin hoặc user',
        ];
    }

     protected function prepareForValidation() {
        $this->merge([
            // 'id' => $this.route('user.show'),
            'id' => $this->route('id'), // Merge id từ route vào request
        ]);
    }
}
