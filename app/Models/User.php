<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'chat_id'
    ];

    public function hasMany($related, $foreignKey = null, $localKey = null): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
