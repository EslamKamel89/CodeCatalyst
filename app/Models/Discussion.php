<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
 * @property-read \App\Models\Post|null $latestPost
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $particpants
 * @property-read int|null $particpants_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discussion orderByLastPost()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User|null $user
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
    protected static function booted() {
        static::created(function (Discussion $discussion) {
            if (! $discussion->slug) {
                $discussion->update(['slug' => "{$discussion->id}-" . str($discussion->title)->slug()]);
            }
        });
    }
    protected function casts(): array {
        return [
            'is_pinned' => 'datetime',
        ];
    }
    public function topic(): BelongsTo {

        return $this->belongsTo(Topic::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isPinned(): bool {
        return $this->pinned_at != null;
    }

    public function scopeOrderByPinned(Builder $query) {
        $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost(Builder $query) {
        $query->orderBy(
            Post::select('created_at')
                ->where('discussion_id', 'discussions.id')
                ->latest()
                ->take(1),
            'desc'
        );
    }
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
    public function replies(): HasMany {
        return $this->hasMany(Post::class)->whereNotNull('parent_id');
    }
    public function post(): HasOne {
        return $this->hasOne(Post::class)->whereNull('parent_id');
    }
    public function latestPost(): HasOne {
        return $this->hasOne(Post::class)->latestOfMany();
    }
    // public function particpants(): HasManyThrough {
    // 	return $this->hasManyThrough(
    // 		User::class,
    // 		Post::class,
    // 		'discussion_id',
    // 		'id',
    // 		'id',
    // 		'id'
    // 	)->distinct();
    // 	return $this->hasManyThrough(
    // 		related: User::class,
    // 		through: Post::class,
    // 		firstKey: 'discussion_id',
    // 		secondKey: 'id',
    // 		localKey: 'id',
    // 		secondLocalKey: 'user_id'
    // 	)->distinct();
    // }

    public function particpants(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'posts',
            'discussion_id',
            'user_id',
        )->distinct();
    }
}
