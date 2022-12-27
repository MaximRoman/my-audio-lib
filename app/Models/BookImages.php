<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'image_id',
    ];

    protected $table = 'book_image';
}
