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
        $readers = Readers::orderBy('created_at', 'DESC')->get();

        return view('book views/reader/select-reader', ['readers' => $readers]);
    }

    public function selectBookReader(Request $request) {
        $readersChecked = json_decode($request->checked);

        if (count($readersChecked) > 0) {
            Session::pull('bookReaders');
            Session::put('bookReaders', $readersChecked);
        } else {
            Session::pull('bookReaders');
        }
        return [
            'result' => Session::get('bookReaders'),
        ];
    }

    public function editSelectedReader(Request $request) {
        $bookId = $request->book;
        $readers = Readers::orderBy('created_at', 'DESC')->get();

        return view('book views/reader/select-reader', ['readers' => $readers, 'bookId' => $bookId]);
    }

    public function editSelectedBookReader(Request $request) {
        $bookId = $request->book;
        $readers = [];
        if (Session::get('bookReaders')) {
            $readers = Session::get('bookReaders');
        }
        
        $editBook = new EditBookController();
        $editBook->updateBookJoin(BookReader::class, $bookId, 'reader_id', $readers);
        return redirect('/edit-book/' . $bookId);
    }
}
