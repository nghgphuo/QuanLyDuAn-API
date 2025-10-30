<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class SearchUserRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            
        ];
    }

    public function messages() {
        return [

        ];
    }
}