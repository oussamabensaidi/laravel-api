<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
     use HasFactory;
    protected $fillable = [
    'titre',
    'description',
    'terminer',
    'user_id',
    ];

            public function user()
    {
        return $this->belongsTo(User::class);
    }

}
