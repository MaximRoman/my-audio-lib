<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookAuthor;

class AuthorController extends Controller
{
    public function createAuthor(Request $request) {
        $form = $request->validate([
            'author' => ['required', 'unique:authors', 'max:255']
        ]);

        Authors::create($form);
        return redirect('/add-book/select-author');
    }

    public function selectAuthor() {
        $authors = Authors::all();

        return view('book views/author/select-author', ['authors' => $authors]);
    }

    public function selectBookAuthor(Request $request) {
        $authorId = $request['authors'];
        Session::put('bookAuthors', $authorId);
        return redirect('/add-book');
    }

    public function editSelectedAuthor(Request $request) {
        $bookId = $request->book;
        $authors = Authors::all();

        return view('book views/author/select-author', ['authors' => $authors, 'bookId' => $bookId]);
    }

    public function editSelectedBookAuthor(Request $request) {
        $bookId = $request->book;
        $authors = $request['authors'];
        $editBook = new EditBookController();
        $editBook->updateBookJoin(BookAuthor::class, $bookId, 'author_id', $authors); 

        return redirect('/edit-book/' . $bookId);
    }
}
