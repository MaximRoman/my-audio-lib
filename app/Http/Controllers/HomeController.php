<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
use App\Models\Series;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {
        $books = Books::all();
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
                                        'category',
                                    ]);
        return view('index', [
                                'books' => $books, 
                                'images' => $images, 
                                'authors' => $authors, 
                                'readers' => $readers, 
                                'series' => $series,
                                'categories' => $categories,
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
