<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'completed', 'description', 'due_date'];

    protected $casts = [
        'completed' => 'boolean'
    ];
}
