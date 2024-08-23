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
}
