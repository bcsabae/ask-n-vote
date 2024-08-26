<?php

namespace App\Models;

use App\Models\Scopes\UnbannedQuestionsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([UnbannedQuestionsScope::class])]
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
