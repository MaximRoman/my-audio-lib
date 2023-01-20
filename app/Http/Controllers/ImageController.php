<?php

namespace App\Http\Controllers;

use App\Models\BookImages;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function addImage(Request $request) {
        $bookId = $request->book;
        return view('book views/image/upload-image', ['bookId' => $bookId]);
    }

    public function uploadImage(Request $request) {
        $bookId = $request->bookId;
        $image = $request->validate([
            'name' => ['required', 'unique:images'],
            'image' => 'required',
        ]);
        $path = $request->file('image')->storeAs('images', $request['name'] . '.' . $request['image']->getClientOriginalName(), 's3');
        
        $form = [
            'name' => $image['name'], 
            'image' => $path,
        ];
        Images::create($form);
        if ($bookId) {    
            return redirect('/edit-book/' . $bookId . '/select-image');
        } else {
            return redirect('/add-book/select-image');
        }
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
        $request->file('file')->storeAs($imageName[0], $imageName[1], 's3');
        
        return redirect('/edit-image/' . $imageId);
    }

    public function editImage(Request $request) {
        $images = Images::all()->where('id', $request->image);

        return view('book views/image/edit-image', ['images' => $images]);
    }

    public function deleteImage(Request $request) {
        $imageId = $request->image;
        $bookImage = BookImages::all()->where('image_id', $imageId)->first();

        if (!$bookImage) {
            $images = Images::all()->where('id', $imageId);
            foreach ($images as $value) {
                Storage::disk('s3')->delete('images/' . $value->image);
            }

            Images::where('id', $request->image)->delete();
            return redirect('/add-book/select-image');
        } else {
            return redirect('/edit-image/' . $imageId . '?message=Это обложка уже используется, вы не можете её удалить!');
        }
    }

    public function selectImage() {
        $images = Images::orderBy('created_at', 'desc')->get();

        return view('book views/image/select-image', ['images' => $images]);
    }

    public function selectBookImage(Request $request) {
        $imageId = $request['image'];
        Session::put('bookImage', $imageId);
        return redirect('/add-book');
    }

    public function editSelectedImage(Request $request) {
        $bookId = $request->book;
        $name = '';
        if (isset($request['name'])) {
            $name = $request->name;
        }
        // dd($name);
        $images = Images::whereRaw('name LIKE("%' . $name . '%")')->get();

        return view('book views/image/select-image', ['images' => $images, 'bookId' => $bookId]);
    }

    public function editSelectedBookImage(Request $request) {
        $bookId = $request->book;
        $imageId = [$request['image']];
        $editBook = new EditBookController();
        $editBook->updateBookJoin(BookImages::class, $bookId, 'image_id', $imageId);
        return redirect('/edit-book/' . $bookId);
    }
}
