<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    
    public function uploadOtherImage(Request $request) {
        $images = Images::all()->where('id', $request->image); 
        $imageName = '';
        $imageId = '';
        foreach ($images as $key => $value) {
            $imageId = $value->id;
            $imageName = explode('/', $value->image);
        }
        $request->validate([
            'file' => 'required'
        ]);
        $path = $request->file('file')->storeAs($imageName[0], $imageName[1], 'public');
        
        return redirect('/edit-image/' . $imageId);
    }

    public function deleteImage(Request $request) {
        $images = Images::all()->where('id', $request->image);
        foreach ($images as $key => $value) {
            Storage::disk('public')->delete($value->image);
        }

        Images::where('id', $request->image)->delete();
        return redirect('/add-book/select-image');
    }

    
}
