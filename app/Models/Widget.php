<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int|null $position
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WidgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Widget whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Widget extends Model
{
    use HasFactory;
}
