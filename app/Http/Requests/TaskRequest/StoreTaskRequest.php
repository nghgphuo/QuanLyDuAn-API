<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in(['Chưa làm', 'Đang làm', 'Hoàn thành'])],
            'priority' => ['required', Rule::in(['Thấp', 'Trung bình', 'Cao'])],
            'assigned_to' => ['required', 'integer', Rule::exists('users', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'deadline.required' => 'Vui lòng chọn hạn chót cho công việc',
            'deadline.date' => 'Định dạng hạn chót không hợp lệ',
            'deadline.after_or_equal' => 'Hạn chót phải là ngày hôm nay hoặc sau đó',
            'status.required' => 'Trạng thái không được để trống',
            'status.in' => 'Trạng thái chỉ được phép: Chưa làm, Đang làm, Hoàn thành',
            'priority.required' => 'Vui lòng chọn mức độ ưu tiên',
            'priority.in' => 'Ưu tiên chỉ được phép: Thấp, Trung bình, Cao',
            'assigned_to.required' => 'Vui lòng chỉ định người được giao',
            'assigned_to.integer' => 'Id người được giao phải là số nguyên',
            'assigned_to.exists' => 'Người được giao không tồn tại trong hệ thống',           
        ];
    }
}
