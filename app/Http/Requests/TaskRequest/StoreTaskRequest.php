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
        'title.required' => __('validation.title.required'),
        'title.max' => __('validation.title.max'),
        'deadline.required' => __('validation.deadline.required'),
        'deadline.date' => __('validation.deadline.date'),
        'deadline.after_or_equal' => __('validation.deadline.after_or_equal'),
        'status.required' => __('validation.status.required'),
        'status.in' => __('validation.status.in'),
        'priority.required' => __('validation.priority.required'),
        'priority.in' => __('validation.priority.in'),
        'assigned_to.required' => __('validation.assigned_to.required'),
        'assigned_to.integer' => __('validation.assigned_to.integer'),
        'assigned_to.exists' => __('validation.assigned_to.exists'),
    ];
    }
}
