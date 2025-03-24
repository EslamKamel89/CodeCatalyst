<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest {

    public function authorize(): bool {
        return auth()->user()->can('reply', $this->discussion);
    }


    public function rules(): array {
        return [
            'body' => ['required', 'min:3', 'max:255'],
        ];
    }
}
