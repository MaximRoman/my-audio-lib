<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookImages;
use App\Models\BookReader;
use App\Models\BookSeries;
use App\Models\Books;
use Illuminate\Support\Facades\Storage;

class DeleteBookController extends Controller
{
    
    public function deleteBook(Request $request) {
        $bookId = $request->book;
        $title = Books::all()->where('id', '=', $bookId)->first()->title;
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
        Storage::disk('public')->deleteDirectory('/' . $title);

        return redirect('/');
    }

    private function deleteRowFromTable($item) {
        if ($item !== null) {
            $item->delete();
        }
    }
}
