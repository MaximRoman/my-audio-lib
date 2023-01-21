<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\BookDuration;
use App\Models\Books;
use App\Models\Categories;
use App\Models\FavBook;
use App\Models\Images;
use App\Models\Readers;
// use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private function getIndexData($page) {
        $link = '';
        $limit = 6;
        $admin = false;
        
        $totalPages = ceil(count(DB::table('books')->orderBy('created_at', 'desc')
                                    ->get()) / $limit);
        $books = DB::table('books')->orderBy('created_at', 'desc')
                    ->skip(($page - 1)*$limit)->take($limit)
                    ->get();
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->get();
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                                    ->get();
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                                    ->get();
        // $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
        //                             ->get([
        //                                 'book_id',
        //                                 'series',
        //                             ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                    ->get();
        $userId = null;
        $fav = [];
        if (Auth::user()) {
            $userId = Auth::user()->id;
            if (DB::table('admin')->where('user_id', $userId)->get()->first()) {
                $admin = true;
            }
            $fav =FavBook::all()->where('user_id', $userId);
        }
        $duration = 0.0;
        
        $duration = BookDuration::all();
        Session::pull('bookTitle');
        Session::pull('bookYear');
        Session::pull('bookDescription');
        Session::pull('bookImage');
        Session::pull('bookAuthors');
        Session::pull('bookReaders');
        // Session::pull('bookSeries');
        Session::pull('bookCategories');

        return [
                'books' => $books, 
                'images' => $images, 
                'authors' => $authors, 
                'readers' => $readers, 
                // 'series' => $series,
                'categories' => $categories,
                'user' => $userId,
                'admin' => $admin,
                'fav' => $fav,
                'duration' => $duration,
                'totalPages' => $totalPages,
                'page' => $page,
                'link' => $link,
            ];
    }
    public function index(Request $request) {
        $page = 1;
        if ($request->page) {
            $page = $request->page;
            if ($request->page == 1) {
                return redirect('/');
            }
        }
        $data = $this->getIndexData($page);
        return view('index', [
                                'books' => $data['books'],
                                'images' => $data['images'],
                                'authors' => $data['authors'],
                                'readers' => $data['readers'],
                                // 'series' => $data['series'],
                                'categories' => $data['categories'],
                                'user' => $data['user'],
                                'admin' => $data['admin'],
                                'fav' => $data['fav'],
                                'duration' => $data['duration'],
                                'totalPages' => $data['totalPages'],
                                'page' => $data['page'],
                                'link' => $data['link'],
                            ]);
    }

    public function home() {
        return redirect('/');
    }   

    public function globalSearch(Request $request) {
        $page = 1;
        $limit = 6;
        $fav = [];
        $admin = false;
        $message = "!По вашему запросу ничего не найдено!";
        $userId = null;

        if (Auth::user()) {
            $userId = Auth::user()->id;
            if (DB::table('admin')->where('user_id', $userId)->get()->first()) {
                $admin = true;
            }
            $fav =FavBook::all()->where('user_id', $userId);
        }
        $search = $request->search;
        
        if ($request->page) {
            $page = $request->page;
            if ($request->page == 1) {
                return redirect('/search/' . $search . '/');
            }
        }
        $link = 'search/' . $search . '/';
        $books = Books::join('book_author', 'book_author.book_id', '=', 'books.id')
                        ->join('book_reader', 'book_reader.book_id', '=', 'books.id')
                        // ->join('book_series', 'book_series.book_id', '=', 'books.id')
                        ->join('authors', 'book_author.author_id', '=', 'authors.id')
                        ->join('readers', 'book_reader.reader_id', '=', 'readers.id')
                        // ->join('series', 'book_series.series_id', '=', 'series.id')
                        ->whereRaw("title LIKE('%" . $search . "%') OR author LIKE('%" . $search . "%') OR reader LIKE('%" . $search . "%')")//OR series LIKE('%" . $search . "%')
                        ->get([
                            'books.id',
                        ]);
        $booksId = [];
        foreach ($books as $value) {
            array_push($booksId, $value->id);
        }
        
        // dd($page*$limit);
        $totalPages = ceil(count(Books::whereIn('id', $booksId)->get()) / $limit);
        $books = Books::whereIn('id', $booksId)
                        ->skip(($page - 1)*$limit)->take($limit)
                        ->get();
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->whereIn('book_id', $booksId)
                        ->get();
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                          ->whereIn('book_id', $booksId)
                                    ->get();
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                          ->whereIn('book_id', $booksId)
                                    ->get();
        // $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
        //                 ->whereIn('book_id', $booksId)
        //                             ->get([
        //                                 'book_id',
        //                                 'series',
        //                             ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                ->whereIn('book_id', $booksId)
                                ->get();
        $duration = 0.0;
        
        $duration = BookDuration::all();
        return view('index', [
                                'books' => $books,
                                'images' => $images,
                                'authors' => $authors,
                                'readers' => $readers,
                                // 'series' => $series,
                                'categories' => $categories,
                                'user' => $userId,
                                'message' => $message,
                                'admin' => $admin,
                                'fav' => $fav,
                                'duration' => $duration,
                                'totalPages' => $totalPages,
                                'page' => $page,
                                'link' => $link,
                            ]);
    }

    public function getBooksByCategory(Request $request) {
        $page = 1;
        $limit = 6;
        $admin = false;
        $userId = null;
        $fav = [];
        if (Auth::user()) {
            $userId = Auth::user()->id;
            if (DB::table('admin')->where('user_id', $userId)->get()->first()) {
                $admin = true;
            }
            $fav =FavBook::all()->where('user_id', $userId);
        }
        $category = $request->category;
        if ($request->page) {
            $page = $request->page;
            if ($request->page == 1) {
                return redirect('/category/' . $category . '/');
            }
        }
        $link = 'category/' . $category . '/';
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
        $totalPages = ceil(count(Books::whereIn('id', $booksId)->get()) / $limit);

        $books = Books::whereIn('id', $booksId)
                        ->orderBy('created_at', 'desc')
                        ->skip(($page - 1)*$limit)->take($limit)
                        ->get();
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->whereIn('book_id', $booksId)
                        ->get();
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                          ->whereIn('book_id', $booksId)
                                    ->get();
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                          ->whereIn('book_id', $booksId)
                                    ->get();
        // $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
        //                 ->whereIn('book_id', $booksId)
        //                             ->get([
        //                                 'book_id',
        //                                 'series',
        //                             ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                ->whereIn('book_id', $booksId)
                                ->get();
        $duration = 0.0;
        
        $duration = BookDuration::all();
        

        return view('index', [
                                'books' => $books,
                                'images' => $images,
                                'authors' => $authors,
                                'readers' => $readers,
                                // 'series' => $series,
                                'categories' => $categories,
                                'user' => $userId,
                                'admin' => $admin,
                                'fav' => $fav,
                                'duration' => $duration,
                                'totalPages' => $totalPages,
                                'page' => $page,
                                'link' => $link,
                                'page' => $page,
                            ]);
    }    
}
