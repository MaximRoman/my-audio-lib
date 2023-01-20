<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Images;
use App\Models\Readers;
// use App\Models\Series;
use Illuminate\Http\Request;

class EditBookController extends Controller
{
    public function updateBookJoin($object, $bookId, $column, $newValues) {
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
        // $series = Series::join('book_series', 'series.id', '=', 'book_series.series_id')
        //                   ->where('book_id', '=', $bookId)
        //                   ->get(['series']);
        $categories = Categories::join('book_category', 'categories.id', '=', 'book_category.category_id')
                                ->where('book_id', '=', $bookId)
                                ->get(['category']);

        return view('book views/book/edit-book', [
                                    'book' => $book,
                                    'image' => $image,
                                    'authors' => $authors,
                                    'readers' => $readers,
                                    // 'series' => $series,
                                    'categories' => $categories,
                                    'bookId' => $bookId,
                                ]);
    }

    public function editTitle(Request $request) {
        $bookId = $request->book;
        return view('book views/book elements/select-title', ['bookId' => $bookId]);
    }

    public function editBookTitle(Request $request) {
        $bookId = $request->book;
        $title = $request->validate([
            'title' => ['required', 'unique:books', 'max:255']
        ]);
        $this->updateBook($bookId, 'title', $title['title']);

        return redirect('/edit-book/' . $bookId);
    }

    public function editYear(Request $request) {
        $bookId = $request->book;
        return view('book views/book elements/select-year', ['bookId' => $bookId]);
    }

    public function editBookYear(Request $request) {
        $bookId = $request->book;
        $year = $request->validate([
            'year' => ['required']
        ]);
        $this->updateBook($bookId, 'year', $year['year']);

        return redirect('/edit-book/' . $bookId);
    }

    public function editDescription(Request $request) {
        $bookId = $request->book;
        return view('book views/book elements/select-description', ['bookId' => $bookId]);
    }

    public function editBookDescription(Request $request) {
        $bookId = $request->book;
        $description = $request->validate([
            'description' => ['required']
        ]);
        $this->updateBook($bookId, 'description', $description['description']);

        return redirect('/edit-book/' . $bookId);
    }
}
