<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'status',
    ];

    protected $table = 'fav_book';
}
