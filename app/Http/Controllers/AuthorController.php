<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BookAuthor;

class AuthorController extends Controller
{
    public function addAuthor(Request $request) {
        $bookId = $request->book;
        return view('book views/author/add-author', ['bookId' => $bookId]);
    }

    public function createAuthor(Request $request) {
        $bookId = $request->bookId;
        $form = $request->validate([
            'author' => ['required', 'unique:authors', 'max:255']
        ]);

        Authors::create($form);
        if ($bookId) {
            return redirect('/edit-book/' . $bookId . '/select-author');
        } else {
            return redirect('/add-book/select-author');
        }
    }

    public function selectAuthor() {
        $authors = Authors::orderBy('created_at', 'DESC')->get();

        return view('book views/author/select-author', ['authors' => $authors]);
    }

    public function selectBookAuthor(Request $request) {
        $authorsChecked = json_decode($request->checked);

        if (count($authorsChecked) > 0) {
            Session::pull('bookAuthors');
            Session::put('bookAuthors', $authorsChecked);
        } else {
            Session::pull('bookAuthors');
        }
        return [
            'result' => Session::get('bookAuthors'),
        ];
    }

    public function editSelectedAuthor(Request $request) {
        $bookId = $request->book;
        $authors = Authors::orderBy('created_at', 'DESC')->get();

        return view('book views/author/select-author', ['authors' => $authors, 'bookId' => $bookId]);
    }

    public function editSelectedBookAuthor(Request $request) {
        $bookId = $request->book;
        $authors = [];
        if (Session::get('bookAuthors')) {
            $authors = Session::get('bookAuthors');
        }
        $editBook = new EditBookController();
        $editBook->updateBookJoin(BookAuthor::class, $bookId, 'author_id', $authors); 

        return redirect('/edit-book/' . $bookId);
    }
}
