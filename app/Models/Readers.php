<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readers extends Model
{
    use HasFactory;

    protected $fillable = [
        'reader',
    ];

    protected $table = 'readers';
}
