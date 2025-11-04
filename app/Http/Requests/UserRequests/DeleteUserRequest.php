<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteUserRequest extends FormRequest
{
    public function authorize() : bool {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'min:1',
                Rule::exists('users', 'id'),
                // Custom rule: Không cho xóa admin cuối cùng
                function ($attribute, $value, $fail) {
                    $user = \App\Models\User::find($value);
                    
                    if ($user && $user->role === 'admin') {
                        $adminCount = \App\Models\User::where('role', 'admin')->count();
                        if ($adminCount <= 1) {
                            $fail('Không thể xóa admin cuối cùng trong hệ thống.');
                        }
                    }
                },
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id người dùng không được để trống',
            'id.integer' => 'Id phải là số nguyên',
            'id.min' => 'Id phải lớn hơn 0',
            'id.exists' => 'Người dùng không tồn tại hoặc đã bị xóa',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Bạn không thể xóa chính mình',
            ], 403)
        );
    }
}