<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_code',
        'is_active',
        'title',
        'user_id'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function(SessionCode $sessionCode) {
            $sessionCode->questions()->delete();
        });
    }
}
