<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\BookDuration;
use App\Models\Books;
use App\Models\Categories;
use App\Models\FavBook;
use App\Models\Grades;
use App\Models\Images;
use App\Models\Readers;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use wapmorgan\Mp3Info\Mp3Info;

class BookController extends Controller
{
    public function showBook(Request $request) {
        $admin = false;
        $bookId = $request->book;
        // $user = null;
        $user = Auth::user();
        $book = Books::all()->where('id', '=', $bookId)->first();
        $images = Images::join('book_image', 'book_image.image_id', '=', 'images.id')
                        ->where('book_id', '=', $bookId)
                        ->get();
        $authors = Authors::join('book_author', 'book_author.author_id', '=', 'authors.id')
                            ->where('book_id', '=', $bookId)
                            ->get();
        $readers = Readers::join('book_reader', 'book_reader.reader_id', '=', 'readers.id')
                                    ->get();
        // $series = Series::join('book_series', 'book_series.series_id', '=', 'series.id')
        //                 ->where('book_id', '=', $bookId)
        //                 ->get([
        //                     'book_id',
        //                     'series',
        //                 ]);
        $categories = Categories::join('book_category', 'book_category.category_id', '=', 'categories.id')
                                ->where('book_id', '=', $bookId)
                                ->get();        
        $grades = Grades::where('book_id', '=', $bookId)->get();
    
        $files = Storage::disk('s3')->files('/' . $book->title);
        $duration = 0.0;
        
        $duration = BookDuration::all();

        $grades = json_encode($grades);
        $files = json_encode($files);
        $user = json_encode($user);
        
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

        return view('book views/book/book-index', [
                                'user' => $user, 
                                'userId' => $userId, 
                                'book' => $book, 
                                'images' => $images, 
                                'authors' => $authors, 
                                'readers' => $readers, 
                                // 'series' => $series,
                                'categories' => $categories,
                                'files' => $files,
                                'duration' => $duration,
                                'grades' => $grades,
                                'admin' => $admin,
                                'fav' => $fav,
                            ]);
    }

    public function selectTitle() {
        return view('book views/book elements/select-title');
    }

    public function selectBookTitle(Request $request) {
        $title = $request->validate([
            'title' => ['required', 'unique:books', 'max:255']
        ]);

        Session::put('bookTitle', $title);

        return redirect('/add-book');
    }

    public function selectYear() {
        return view('book views/book elements/select-year');
    }

    public function selectBookYear(Request $request) {
        $year = $request->validate([
            'year' => ['required']
        ]);

        Session::put('bookYear', $year);

        return redirect('/add-book');
    }

    public function selectDescription() {
        return view('book views/book elements/select-description');
    }

    public function selectBookDescription(Request $request) {
        $description = $request->validate([
            'description' => ['required']
        ]);

        Session::put('bookDescription', $description);

        return redirect('/add-book');
    }
}
