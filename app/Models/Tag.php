<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
