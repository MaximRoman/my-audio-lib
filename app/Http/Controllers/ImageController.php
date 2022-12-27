<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required'
        ]);
        $path = $request->file('image')->store('images', 'public');
        
        Images::create(['image' => $path]);
        return redirect('/add-book/select-image');
    }
}
