<?php

namespace App\Models;

use Database\Factories\PageFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
 * @property string|null $featured_image_type
 * @property string|null $featured_image_external_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PageFactory factory($count = null, $state = [])
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereContent($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereFeaturedImageAlt($value)
 * @method static Builder|Page whereFeaturedImagePath($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereMetaDescription($value)
 * @method static Builder|Page whereMetaKeywords($value)
 * @method static Builder|Page whereName($value)
 * @method static Builder|Page wherePublished($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @method static Builder|Page whereUrl($value)
 * @mixin Eloquent
 */
class Page extends Model
{
    use HasFactory;

    const PAGES_IMAGES_PATH = 'pages/';

    /**
     * @return Attribute
     * @property string|null $image_path
     * */
    protected function imagePath() : Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes)  {
                $path = $attributes['featured_image_path'] ?? $attributes['featured_image_external_url'];

                if (! str_starts_with($path, 'https://') && $path) {
                    $path = Storage::disk('public')->url(self::PAGES_IMAGES_PATH . $path);
                }

                return $path;
            }
        );
    }
}
