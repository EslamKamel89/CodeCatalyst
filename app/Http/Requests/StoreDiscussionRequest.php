<?php

namespace App\Http\Requests;

use App\Models\Discussion;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class StoreDiscussionRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		/** @var User $user */
		$user = auth()->user();
		return $user->can( 'create', Discussion::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return [ 
			'topic_id' => [ 'required', 'exists:topics,id' ],
			'title' => [ 'required', 'min:3', 'max:150' ],
			'body' => [ 'required', 'min:3', 'max:250' ],
		];
	}
}
