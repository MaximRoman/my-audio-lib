<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookImages;
use App\Models\BookReader;
use App\Models\Books;
use App\Models\BookSeries;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{

    public function addBook() {
        $validate = false;
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
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookTitle')) {
            $title = Session::get('bookTitle');
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookAuthors')) {
            $authors = Authors::all()->whereIn('id', Session::get('bookAuthors'));
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookReaders')) {
            $readers = Readers::all()->whereIn('id', Session::get('bookReaders'));
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookYear')) {
            $year = Session::get('bookYear');
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookSeries')) {
            $series = Series::all()->whereIn('id', Session::get('bookSeries'));
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookCategories')) {
            $categories = Categories::all()->whereIn('id', Session::get('bookCategories'));
            $validate = true;
        } else {
            $validate = true;
        }
        if (Session::get('bookDescription')) {
            $description = Session::get('bookDescription');
            $validate = true;
        } else {
            $validate = true;
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
                                    'validate' => $validate,
                                ]);
    }

    private function deleteRowFromTable($item) {
        if ($item !== null) {
            $item->delete();
        }
    }

    public function createBook() {
        $title = Session::get('bookTitle');
        $year = Session::get('bookYear');
        $description = Session::get('bookDescription');
        $image = Session::get('bookImage');
        $authors = Session::get('bookAuthors');
        $readers = Session::get('bookReaders');
        $series = Session::get('bookSeries');
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

        $bookSeriesForm = [
            'book_id' => $bookId,
            'series_id' => $series,
        ];
        BookSeries::create($bookSeriesForm);

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
        Session::pull('bookSeries');
        Session::pull('bookCategories');

        return redirect('/'); 
    }

    public function deleteBook(Request $request) {
        $bookId = $request->book;
        $bookAuthor = BookAuthor::where('book_id', $bookId);
        $bookReader =  BookReader::where('book_id', $bookId);
        $bookCategory = BookCategory::where('book_id', $bookId);
        $bookSeries = BookSeries::where('book_id', $bookId);
        $bookImages = BookImages::where('book_id', $bookId);
        $books = Books::where('id', $bookId);

        $this->deleteRowFromTable($bookAuthor);
        $this->deleteRowFromTable($bookReader);
        $this->deleteRowFromTable($bookCategory);
        $this->deleteRowFromTable($bookSeries);
        $this->deleteRowFromTable($bookImages);
        $this->deleteRowFromTable($books);

        return redirect('/');
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

    public function selectTitle() {
        return view('select-title');
    }

    public function selectBookTitle(Request $request) {
        $title = $request->validate([
            'title' => ['required', 'unique:books', 'max:255']
        ]);

        Session::put('bookTitle', $title);

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
        $readers = $request['readers'];
        Session::put('bookReaders', $readers);
        return redirect('/add-book');
    }

    public function selectYear() {
        return view('select-year');
    }

    public function selectBookYear(Request $request) {
        $year = $request->validate([
            'year' => ['required']
        ]);

        Session::put('bookYear', $year);

        return redirect('/add-book');
    }

    public function selectSeries() {
        $series = Series::all();

        return view('select-series', ['series' => $series]);
    }

    public function selectBookSeries(Request $request) {
        $series = $request->series;

        Session::put('bookSeries', $series);

        return redirect('/add-book');
    }

    public function selectCategory() {
        $categories = Categories::all();

        return view('select-category', ['categories' => $categories]);
    }

    public function selectBookCategory(Request $request) {
        $categories = $request->categories;

        Session::put('bookCategories', $categories);

        return redirect('/add-book');
    }

    public function selectDescription() {
        return view('select-description');
    }

    public function selectBookDescription(Request $request) {
        $description = $request->validate([
            'description' => ['required']
        ]);

        Session::put('bookDescription', $description);

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
