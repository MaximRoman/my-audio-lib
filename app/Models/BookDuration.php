<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'duration',
    ];

    protected $table = 'book_duration';
}
