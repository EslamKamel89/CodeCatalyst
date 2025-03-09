<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( Request $request ): array {
		return [ 
			'id' => $this->id,
			'user_id' => $this->user_id,
			'topic_id' => $this->topic_id,
			'title' => $this->title,
			'slug' => $this->slug,
			'pinned_at' => $this->pinned_at,
			'topic' => TopicResource::make( $this->whenLoaded( 'topic' ) )
		];
	}
}
