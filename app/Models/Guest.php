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
}
