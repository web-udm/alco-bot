<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $update_id
 * @property string $text
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class Message extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'update_id',
        'text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
