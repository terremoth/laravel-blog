<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $post_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Post|null $post
 * @method static TagFactory factory($count = null, $state = [])
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @method static Builder|Tag wherePostId($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    public function post(): HasOne
    {
        return $this->hasOne(Post::class);
    }

    public static function halfTags(): array
    {
        $tags = self::selectRaw('DISTINCT(name) as name')->orderBy('name');
        $halfTags = (int)ceil($tags->get()->count() / 2);
        $first = $tags->limit($halfTags)->get();
        $second = $tags->skip($halfTags)->get();
        return compact('first', 'second');
    }
}
