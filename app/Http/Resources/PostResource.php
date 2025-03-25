<?php

namespace App\Http\Resources;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class PostResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'discussion_id' => $this->discussion_id,
            'parent_id' => $this->parent_id,
            'body' => $this->body,
            'body_markdown' => app(MarkdownRenderer::class)
                ->highlightTheme('dracula')
                ->toHtml($this->body),
            'body_preview' => str($this->body)->limit(200),
            'body_preview_markdown' => app(MarkdownRenderer::class)->toHtml(str($this->body)->limit(200)),
            'user' => PublicUserResource::make($this->whenLoaded('user')),
            'discussion' => DiscussionResource::make($this->whenLoaded('discussion')),
            'created_at' => DateTimeResource::make($this->created_at),
            'updated_at' => DateTimeResource::make($this->updated_at),
            'user_can' => [
                'update' => auth()->user()?->can('update', $this->resource),
            ]
        ];
    }
}
