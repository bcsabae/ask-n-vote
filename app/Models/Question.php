<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'upvotes',
        'is_answered',
        'asked_by',
        'guest_id'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function sessionCode()
    {
        return $this->guest->sessionCode();
    }
}
