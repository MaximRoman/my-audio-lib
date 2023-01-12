<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private function getIndexData() {
        $admin = false;
        $books = DB::table('books')->orderBy('created_at', 'desc')->get();
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->get([
                            'book_id',
                            'image',
                        ]);
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                                    ->get([
                                        'book_id',
                                        'author',
                                    ]);
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                                    ->get([
                                        'book_id',
                                        'reader',
                                    ]);
        $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
                                    ->get([
                                        'book_id',
                                        'series',
                                    ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                    ->get([
                                        'book_id',
                                        'temp_category',
                                        'category',
                                    ]);
        $userId = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        Session::pull('bookTitle');
        Session::pull('bookYear');
        Session::pull('bookDescription');
        Session::pull('bookImage');
        Session::pull('bookAuthors');
        Session::pull('bookReaders');
        Session::pull('bookSeries');
        Session::pull('bookCategories');

        return [
                'books' => $books, 
                'images' => $images, 
                'authors' => $authors, 
                'readers' => $readers, 
                'series' => $series,
                'categories' => $categories,
                'user' => $userId,
                'admin' => $admin,
            ];
    }
    public function index() {
        $data = $this->getIndexData();
        return view('index', [
                                'books' => $data['books'],
                                'images' => $data['images'],
                                'authors' => $data['authors'],
                                'readers' => $data['readers'],
                                'series' => $data['series'],
                                'categories' => $data['categories'],
                                'user' => $data['user'],
                            ]);
    }

    public function home() {
        $data = $this->getIndexData();
        return view('index', [
                                'books' => $data['books'],
                                'images' => $data['images'],
                                'authors' => $data['authors'],
                                'readers' => $data['readers'],
                                'series' => $data['series'],
                                'categories' => $data['categories'],
                                'user' => $data['user'],
                            ]);
    }   

    public function globalSearch(Request $request) {
        $message = "!По вашему запросу ничего не найдено!";
        $userId = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        $search = $request->search;
        $books = Books::join('book_author', 'book_author.book_id', '=', 'books.id')
                        ->join('book_reader', 'book_reader.book_id', '=', 'books.id')
                        ->join('book_series', 'book_series.book_id', '=', 'books.id')
                        ->join('authors', 'book_author.author_id', '=', 'authors.id')
                        ->join('readers', 'book_reader.reader_id', '=', 'readers.id')
                        ->join('series', 'book_series.series_id', '=', 'series.id')
                        ->whereRaw("title LIKE('%" . $search . "%') OR author LIKE('%" . $search . "%') OR reader LIKE('%" . $search . "%') OR series LIKE('%" . $search . "%')")
                        ->get([
                            'books.id',
                        ]);
        $booksId = [];
        foreach ($books as $value) {
            array_push($booksId, $value->id);
        }
        $books = Books::all()->whereIn('id', $booksId);
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->whereIn('book_id', $booksId)
                        ->get([
                            'book_id',
                            'image',
                        ]);
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                          ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'author',
                                    ]);
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                          ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'reader',
                                    ]);
        $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
                        ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'series',
                                    ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                ->whereIn('book_id', $booksId)
                                ->get([
                                    'book_id',
                                    'category',
                                ]);
        return view('index', [
                                'books' => $books,
                                'images' => $images,
                                'authors' => $authors,
                                'readers' => $readers,
                                'series' => $series,
                                'categories' => $categories,
                                'user' => $userId,
                                'message' => $message,
                            ]);
    }

    public function getBooksByCategory(Request $request) {
        $userId = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        $category = $request->category;
        $books = Books::join('book_category', 'book_category.book_id', '=', 'books.id')
                        ->join('categories', 'categories.id', '=', 'book_category.category_id')
                        ->whereRaw('temp_category = "' . $category . '"')
                        ->get([
                            'books.id',
                        ]);
        $booksId = [];
        foreach ($books as $value) {
            array_push($booksId, $value->id);
        }
        $books = Books::all()->whereIn('id', $booksId);
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->whereIn('book_id', $booksId)
                        ->get([
                            'book_id',
                            'image',
                        ]);
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                          ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'author',
                                    ]);
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                          ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'reader',
                                    ]);
        $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
                        ->whereIn('book_id', $booksId)
                                    ->get([
                                        'book_id',
                                        'series',
                                    ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                ->whereIn('book_id', $booksId)
                                ->get([
                                    'book_id',
                                    'category',
                                ]);
        return view('index', [
                                'books' => $books,
                                'images' => $images,
                                'authors' => $authors,
                                'readers' => $readers,
                                'series' => $series,
                                'categories' => $categories,
                                'user' => $userId,
                            ]);
    }    

    public function addAuthor() {
        return view('add-author');
    }

    public function addReader() {
        return view('add-reader');
    }

    public function addSeries() {
        return view('add-series');
    }

    public function addCategory() {
        return view('add-category');
    }
}
