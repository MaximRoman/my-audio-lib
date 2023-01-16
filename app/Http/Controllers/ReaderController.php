<?php

namespace App\Http\Controllers;

use App\Models\BookReader;
use App\Models\Readers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReaderController extends Controller
{
    public function addReader() {
        return view('book views/reader/add-reader');
    }

    public function createReader(Request $request) {
        $form = $request->validate([
            'reader' => ['required', 'unique:readers', 'max:255']
        ]);

        Readers::create($form);
        return redirect('/add-book/select-reader');
    }
    public function selectReader() {
        $readers = Readers::all();

        return view('book views/reader/select-reader', ['readers' => $readers]);
    }

    public function selectBookReader(Request $request) {
        $readers = $request['readers'];
        Session::put('bookReaders', $readers);
        return redirect('/add-book');
    }

    public function editSelectedReader(Request $request) {
        $bookId = $request->book;
        $readers = Readers::all();

        return view('book views/reader/select-reader', ['readers' => $readers, 'bookId' => $bookId]);
    }

    public function editSelectedBookReader(Request $request) {
        $bookId = $request->book;
        $readers = $request['readers'];
        $this->updateBookJoin(BookReader::class, $bookId, 'reader_id', $readers);
        return redirect('/edit-book/' . $bookId);
    }
}
