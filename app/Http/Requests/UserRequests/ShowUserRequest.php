<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowUserRequest extends FormRequest
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
            'id' => ['required', 'integer', Rule::exists('users', 'id')]
        ];
    }

    public function messages() {
        return [
            'id.required' => 'Id người dùng không được để trống',
            'id.integer' => 'Id phải là số nguyên',
            'id.exists' => 'Người dùng không tồn tại'
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'id' => $this->route('id'), // Merge id từ route vào request
        ]);
    }
}
