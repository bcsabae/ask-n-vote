<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "session_code_id",
        "banned"
    ];

    public function sessionCode()
    {
        return $this->belongsTo(SessionCode::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    protected static function booted()
    {
        static::deleting(function(Guest $guest) {
            $guest->questions()->delete();
        });
    }
}
