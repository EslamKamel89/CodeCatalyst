<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $topic_id
 * @property string $title
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Topic $topic
 * @property-read \App\Models\User|null $users
 * @method static \Database\Factories\DiscussionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion whereUserId($value)
 * @property string|null $pinned_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion wherePinnedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion orderByPinned()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \App\Models\Post|null $post
 * @mixin \Eloquent
 */
class Discussion extends Model {
	/** @use HasFactory<\Database\Factories\DiscussionFactory> */
	use HasFactory;
	protected $fillable = [ 
		'user_id',
		'topic_id',
		'title',
		'slug',
		'pinned_at'
	];
	protected function casts(): array {
		return [ 
			'is_pinned' => 'datetime',
		];
	}
	public function topic(): BelongsTo {
		return $this->belongsTo( Topic::class);
	}
	public function users(): BelongsTo {
		return $this->belongsTo( User::class);
	}

	public function isPinned(): bool {
		return $this->pinned_at != null;
	}

	public function scopeOrderByPinned( Builder $query ) {
		$query->orderBy( 'pinned_at', 'desc' );
	}
	public function posts(): HasMany {
		return $this->hasMany( Post::class);
	}
	public function post(): HasOne {
		return $this->hasOne( Post::class)->whereNull( 'parent_id' );
	}

}
