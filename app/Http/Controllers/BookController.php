<?php

namespace App\Http\Controllers;

use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookImages;
use App\Models\BookReader;
use App\Models\Books;
use App\Models\BookSeries;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function deleteRowFromTable($item) {
        if ($item !== null) {
            $item->delete();
        }
    }

    public function createBook(Request $request) {
        echo 'createBook';
        // $form = $request->validate([
        //     'title' => ['required', 'unique:books', 'max:255'],
        //     'year' => ['required'],
        //     'description' => ['required'],
        // ]);

        // Books::create($form);
        // return redirect('/'); 
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
}
