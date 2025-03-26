<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPatchRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->user()->can('update', $this->post);
    }


    public function rules(): array {
        return [
            'body' => ['required', 'min:3', 'max:255'],
        ];
    }
}
