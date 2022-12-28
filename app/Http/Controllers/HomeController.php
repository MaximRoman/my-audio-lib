<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Images;
use App\Models\Readers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $books = Books::all();

        return view('index', ['books' => $books]);
    }

    public function addAuthor() {
        return view('add-author');
    }

    public function addBook() {
        $image = [];
        $title = [];
        $authors = [];
        $readers = [];
        $year = [];
        $series = [];
        $categories = [];
        $description = [];
        if (Session::get('bookImage')) {
            $image = Images::all()->where('id', Session::get('bookImage'));
        }
        if (Session::get('bookAuthors')) {
            $authors = Authors::all()->whereIn('id', Session::get('bookAuthors'));
        }
        if (Session::get('bookReaders')) {
            $readers = Readers::all()->whereIn('id', Session::get('bookReaders'));
        }
        return view('add-book', [
                                    'image' => $image, 
                                    'title' => $title, 
                                    'authors' => $authors, 
                                    'readers' => $readers,
                                    'year' => $year,
                                    'series' => $series,
                                    'categories' => $categories,
                                    'description' => $description,
                                ]);
    }

    public function selectImage() {
        $images = Images::all();

        return view('select-image', ['images' => $images]);
    }

    public function editImage(Request $request) {
        $images = Images::all()->where('id', $request->image);

        return view('edit-image', ['images' => $images]);
    }

    public function selectBookImage(Request $request) {
        $imageId = $request['image'];
        Session::put('bookImage', $imageId);
        return redirect('/add-book');
    }

    public function selectAuthor() {
        $authors = Authors::all();

        return view('select-author', ['authors' => $authors]);
    }

    public function selectBookAuthor(Request $request) {
        $authorId = $request['authors'];
        Session::put('bookAuthors', $authorId);
        return redirect('/add-book');
    }

    public function selectReader() {
        $readers = Readers::all();

        return view('select-reader', ['readers' => $readers]);
    }

    public function selectBookReader(Request $request) {
        $readers = $request['authors'];
        Session::put('bookReaders', $readers);
        return redirect('/add-book');
    }
    
    public function addImage() {
        return view('upload-image');
    }

    public function editBook() {
        return view('edit-book');
    }

    public function uploadFiles() {
        return view('upload-files');
    }

    public function uploadBookImage() {
        return view('upload-image');
    }
}
