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

class EditBookController extends Controller
{
    private function updateBookJoin($object, $bookId, $column, $newValues) {
        $object::where('book_id', '=', $bookId)->delete();
        foreach ($newValues as $value) {
            $form = [
                'book_id' => $bookId,
                $column => $value,
            ];
            $object::create($form);
        }
    }

    private function updateBook($bookId, $column, $value) {
        Books::all()->where('id', '=', $bookId)->first()->update([$column => $value]);
    }

    public function editBook(Request $request) {
        $bookId = $request->book;
        $book = Books::all()->where('id', '=', $bookId);
        $image = Images::join('book_image', 'images.id', '=', 'book_image.image_id')
                        ->where('book_id', '=', $bookId)
                        ->get(['image']);
        $authors = Authors::join('book_author', 'authors.id', '=', 'book_author.author_id')
                            ->where('book_id', '=', $bookId)
                            ->get(['author']);
        $readers = Readers::join('book_reader', 'readers.id', '=', 'book_reader.reader_id')
                            ->where('book_id', '=', $bookId)
                            ->get(['reader']);
        $series = Series::join('book_series', 'series.id', '=', 'book_series.series_id')
                          ->where('book_id', '=', $bookId)
                          ->get(['series']);
        $categories = Categories::join('book_category', 'categories.id', '=', 'book_category.category_id')
                                ->where('book_id', '=', $bookId)
                                ->get(['category']);

        return view('edit-book', [
                                    'book' => $book,
                                    'image' => $image,
                                    'authors' => $authors,
                                    'readers' => $readers,
                                    'series' => $series,
                                    'categories' => $categories,
                                    'bookId' => $bookId,
                                ]);
    }

    public function editImage(Request $request) {
        $bookId = $request->book;
        $images = Images::all();

        return view('select-image', ['images' => $images, 'bookId' => $bookId]);
    }

    public function editBookImage(Request $request) {
        $bookId = $request->book;
        $imageId = [$request['image']];
        $this->updateBookJoin(BookImages::class, $bookId, 'image_id', $imageId);
        return redirect('/edit-book/' . $bookId);
    }

    public function editTitle(Request $request) {
        $bookId = $request->book;
        return view('select-title', ['bookId' => $bookId]);
    }

    public function editBookTitle(Request $request) {
        $bookId = $request->book;
        $title = $request->validate([
            'title' => ['required', 'unique:books', 'max:255']
        ]);
        $this->updateBook($bookId, 'title', $title['title']);

        return redirect('/edit-book/' . $bookId);
    }

    public function editAuthor(Request $request) {
        $bookId = $request->book;
        $authors = Authors::all();

        return view('select-author', ['authors' => $authors, 'bookId' => $bookId]);
    }

    public function editBookAuthor(Request $request) {
        $bookId = $request->book;
        $authors = $request['authors'];
        $this->updateBookJoin(BookAuthor::class, $bookId, 'author_id', $authors); 

        return redirect('/edit-book/' . $bookId);
    }

    public function editReader(Request $request) {
        $bookId = $request->book;
        $readers = Readers::all();

        return view('select-reader', ['readers' => $readers, 'bookId' => $bookId]);
    }

    public function editBookReader(Request $request) {
        $bookId = $request->book;
        $readers = $request['readers'];
        $this->updateBookJoin(BookReader::class, $bookId, 'reader_id', $readers);
        return redirect('/edit-book/' . $bookId);
    }

    public function editYear(Request $request) {
        $bookId = $request->book;
        return view('select-year', ['bookId' => $bookId]);
    }

    public function editBookYear(Request $request) {
        $bookId = $request->book;
        $year = $request->validate([
            'year' => ['required']
        ]);
        $this->updateBook($bookId, 'year', $year['year']);

        return redirect('/edit-book/' . $bookId);
    }

    public function editSeries(Request $request) {
        $bookId = $request->book;
        $series = Series::all();

        return view('select-series', ['series' => $series, 'bookId' => $bookId]);
    }

    public function editBookSeries(Request $request) {
        $bookId = $request->book;
        $series = [$request->series];
        $this->updateBookJoin(BookSeries::class, $bookId, 'series_id', $series);

        return redirect('/edit-book/' . $bookId);
    }

    public function editCategory(Request $request) {
        $bookId = $request->book;
        $categories = Categories::all();

        return view('select-category', ['categories' => $categories, 'bookId' => $bookId]);
    }

    public function editBookCategory(Request $request) {
        $bookId = $request->book;
        $categories = $request->categories;
        $this->updateBookJoin(BookCategory::class, $bookId, 'category_id', $categories);
        return redirect('/edit-book/' . $bookId);
    }

    public function editDescription(Request $request) {
        $bookId = $request->book;
        return view('select-description', ['bookId' => $bookId]);
    }

    public function editBookDescription(Request $request) {
        $bookId = $request->book;
        $description = $request->validate([
            'description' => ['required']
        ]);
        $this->updateBook($bookId, 'description', $description['description']);

        return redirect('/edit-book/' . $bookId);
    }
    public function editBookFiles(Request $request) {
        $bookId = $request->book;
        $book = Books::all()->where('id', '=', $bookId)->first();
        $json = json_encode(['id' => $bookId, 'title' => $book->title]);
        return view('upload-files', ['book' => $json]);
    }
    
}
