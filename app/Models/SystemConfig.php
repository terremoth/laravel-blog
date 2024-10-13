<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SystemConfigFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemConfig whereValue($value)
 * @mixin \Eloquent
 */
class SystemConfig extends Model
{
    use HasFactory;
}
