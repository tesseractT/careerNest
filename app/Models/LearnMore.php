<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnMore extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'main_title',
        'sub_title',
        'image',
        'url',
        'id'
    ];
}
