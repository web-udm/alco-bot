<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Cocktail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property mixed $ingredients
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cocktail wherePhoto($value)
 */
class Cocktail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'photo',
        'ingredients'
    ];
}
