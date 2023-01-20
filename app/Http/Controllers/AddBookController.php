<?php

namespace App\Http\Controllers;


use App\Models\Authors;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookImages;
use App\Models\BookReader;
use App\Models\Books;
// use App\Models\BookSeries;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
// use App\Models\Series;
use Illuminate\Support\Facades\Session;

class AddBookController extends Controller
{

    public function addBook() {
        $validate = false;
        $image = [];
        $title = [];
        $authors = [];
        $readers = [];
        $year = [];
        // $series = [];
        $categories = [];
        $description = [];
        if (Session::get('bookImage')) {
            $image = Images::all()->where('id', Session::get('bookImage'));
            $validate = true;
        } else {
            $validate = false;
        }
        if (Session::get('bookTitle')) {
            $title = Session::get('bookTitle');
            $validate = true;
        } else {
            $validate = false;
        }
        if (Session::get('bookAuthors')) {
            $authors = Authors::all()->whereIn('id', Session::get('bookAuthors'));
            $validate = true;
        } else {
            $validate = false;
        }
        if (Session::get('bookReaders')) {
            $readers = Readers::all()->whereIn('id', Session::get('bookReaders'));
            $validate = true;
        } else {
            $validate = false;
        }
        if (Session::get('bookYear')) {
            $year = Session::get('bookYear');
            $validate = true;
        } else {
            $validate = false;
        }
        // if (Session::get('bookSeries')) {
        //     $series = Series::all()->whereIn('id', Session::get('bookSeries'));
        //     $validate = true;
        // } else {
        //     $validate = false;
        // }
        if (Session::get('bookCategories')) {
            $categories = Categories::all()->whereIn('id', Session::get('bookCategories'));
            $validate = true;
        } else {
            $validate = false;
        }
        if (Session::get('bookDescription')) {
            $description = Session::get('bookDescription');
            $validate = true;
        } else {
            $validate = false;
        }

        return view('book views/book/add-book', [
                                    'image' => $image, 
                                    'title' => $title, 
                                    'authors' => $authors, 
                                    'readers' => $readers,
                                    'year' => $year,
                                    // 'series' => $series,
                                    'categories' => $categories,
                                    'description' => $description,
                                    'validate' => $validate,
                                ]);
    }

    public function createBook() {
        $title = Session::get('bookTitle');
        $year = Session::get('bookYear');
        $description = Session::get('bookDescription');
        $image = Session::get('bookImage');
        $authors = Session::get('bookAuthors');
        $readers = Session::get('bookReaders');
        // $series = Session::get('bookSeries');
        $categories = Session::get('bookCategories');
        
        $bookForm = [
            'title' => $title['title'],
            'year' => $year['year'],
            'description' => $description['description'],
        ];

        $bookId = Books::create($bookForm)->id;

        $bookImageForm = [
            'book_id' => $bookId,
            'image_id' => $image,
        ];
        
        BookImages::create($bookImageForm);

        foreach ($authors as $value) {
            $bookAuthorForm = [
                'book_id' => $bookId,
                'author_id' => $value,
            ];
            BookAuthor::create($bookAuthorForm);
        }

        foreach ($readers as $value) {
            $bookReaderForm = [
                'book_id' => $bookId,
                'reader_id' => $value,
            ];
            BookReader::create($bookReaderForm);
        }

        // $bookSeriesForm = [
        //     'book_id' => $bookId,
        //     'series_id' => $series,
        // ];
        // BookSeries::create($bookSeriesForm);

        foreach ($categories as $value) {
            $bookCategoryForm = [
                'book_id' => $bookId,
                'category_id' => $value,
            ];
            BookCategory::create($bookCategoryForm);
        }

        
        Session::pull('bookTitle');
        Session::pull('bookYear');
        Session::pull('bookDescription');
        Session::pull('bookImage');
        Session::pull('bookAuthors');
        Session::pull('bookReaders');
        // Session::pull('bookSeries');
        Session::pull('bookCategories');

        return redirect('/add-book/' . $bookId . '/upload-files'); 
    }
}
