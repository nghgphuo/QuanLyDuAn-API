<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowTaskRequest extends FormRequest
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
        if ($this->routeIs('tasks.getByUser')) {
            return [
                'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            ];
        } 
        return [
            'id' => ['required', 'integer', Rule::exists('tasks', 'id')],
        ];
    }

    public function messages() {
        // return [
        //     'id.required' => 'Task Id không được để trống',
        //     'id.integer' => 'Task Id phải là số nguyên',
        //     'id.exists' => 'Task không tồn tại',
        //     'user_id.required' => 'Id người dùng không được để trống',
        //     'user_id.integer' => 'Id người dùng phải là số nguyên',
        //     'user_id.exists' => 'Người dùng không tồn tại'
        // ];


        return [
            'id.required' => __('validation.required', ['attribute' => __('validation.attributes.id')]),
            'id.integer' => __('validation.integer', ['attribute' => __('validation.attributes.id')]),
            'id.exists' => __('validation.exists', ['attribute' => __('validation.attributes.id')]),

            'user_id.required' => __('validation.required', ['attribute' => __('validation.attributes.user_id')]),
            'user_id.integer' => __('validation.integer', ['attribute' => __('validation.attributes.user_id')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('validation.attributes.user_id')]),
        ];
    }

    protected function prepareForValidation() {
        if ($this->routeIs('tasks.getByUser')) {
            $this->merge(['user_id' => $this->route('user_id')]);
        } else {
            $this->merge(['id' => $this->route('id')]);
        }
    }
}
