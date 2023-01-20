<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
use App\Models\Series;
use App\Models\FavBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavBookController extends Controller
{
    public function setFavBook(Request $request) {
        $userId = Auth::user()->id;
        $bookId = $request->book;
        $status = $request->status;
        $favBook = FavBook::whereRaw('user_id = ' . $userId . ' AND book_id = ' . $bookId)->get()->first();
        $form = [
            'user_id' => $userId,
            'book_id' => $bookId,
            'status' => $status,
        ];

        if ($favBook) {
            $favBook->update($form);
        } else {
            FavBook::create($form);
        }
    }

    public function getFavStatus(Request $request) {
        $userId = Auth::user();
        if ($userId) {
            $userId = $userId->id;
            $bookId = $request->book;
            $favBook = FavBook::whereRaw('user_id = ' . $userId . ' AND book_id = ' . $bookId)->get('status')->first();
            
            if ($favBook) {
                return [
                    'status' => $favBook->status
                ];
            }
        }
        return [
            'status' => json_encode(false),
            'user' => $userId,
        ];
    }

    public function getFavBooks() {
        $message = "!У вас нет книг в закладках!";
        $userId = Auth::user()->id;
        $fav = FavBook::all()->where('user_id', $userId);
        $admin = false;
        if (DB::table('admin')->where('user_id', $userId)->get()->first()) {
            $admin = true;
        }
        $booksId = [];
        $books = Books::join('fav_book', 'fav_book.book_id', '=', 'books.id')
                        ->whereRaw('user_id = ' . $userId . ' AND fav_book.status = 1')
                        ->get([
                            'books.id',
                            'books.title',
                            'books.year',
                            'books.description',      
                        ]);

        foreach ($books as $value) {
            array_push($booksId, $value->id);
        }

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
                                'fav' => $fav,
                                'admin' => $admin,
        ]);
    }
}
