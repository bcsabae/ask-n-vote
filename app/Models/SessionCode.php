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
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    protected static function booted()
    {
        static::deleting(function(SessionCode $sessionCode) {
            $sessionCode->questions()->delete();
        });
    }
}
