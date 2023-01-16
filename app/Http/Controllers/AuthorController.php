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

    public function selectAuthor(Request $request) {
        $name = '';
        if (isset($request['name'])) {
            $name = $request->name;
        }
        $authors = Authors::whereRaw('author LIKE("%' . $name . '%")')->get();

        return view('book views/author/select-author', ['authors' => $authors]);
    }

    public function selectBookAuthor(Request $request) {
        $authorId = $request->author;
        $checked = $request->checked;
        $array = [];

        if ($checked != 3) {
            if (Session::get('bookAuthors')) {
                $array = Session::get('bookAuthors');
            }
    
            if ($checked == 1) {    
                Session::pull('bookAuthors');
                array_push($array, $authorId);
                Session::put('bookAuthors', $array);
            } else {
                Session::pull('bookAuthors');
                array_splice($array, array_search($authorId, $array), 1);
                Session::put('bookAuthors', $array);
            }
        } else {
            Session::pull('bookAuthors');
        }
        return [
            'result' => Session::get('bookAuthors')
        ];
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
