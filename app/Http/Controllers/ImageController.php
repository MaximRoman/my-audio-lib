<?php

namespace App\Http\Controllers;

use App\Models\BookImages;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function addImage() {
        return view('upload-image');
    }

    public function uploadImage(Request $request) {
        $image = $request->validate([
            'file_name' => ['required', 'min:1'],
            'image' => 'required',
        ]);
        $path = $request->file('image')->storeAs('images', $image['file_name'] . '.' . $image['image']->getClientOriginalExtension(), 'public');
        
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

    public function editImage(Request $request) {
        $images = Images::all()->where('id', $request->image);

        return view('edit-image', ['images' => $images]);
    }

    public function deleteImage(Request $request) {
        $imageId = $request->image;
        $bookImage = BookImages::all()->where('image_id', $imageId)->first();

        if (!$bookImage) {
            $images = Images::all()->where('id', $imageId);
            foreach ($images as $value) {
                Storage::disk('public')->delete($value->image);
            }

            Images::where('id', $request->image)->delete();
            return redirect('/add-book/select-image');
        } else {
            return redirect('/edit-image/' . $imageId . '?message=Это обложка уже используется, вы не можете её удалить!');
        }
    }

    
}
