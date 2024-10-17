<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $published
 * @property string|null $content
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $featured_image_path
 * @property string|null $featured_image_alt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereFeaturedImageAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereFeaturedImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUrl($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    use HasFactory;

    const PAGES_IMAGES_PATH = 'pages/';

    public static function solveFeaturedImageUrl(string $url): string
    {
        if (str_starts_with($url, 'https://')) {
            return $url;
        }

        return Storage::disk('public')->url(self::PAGES_IMAGES_PATH . $url);
    }
}
