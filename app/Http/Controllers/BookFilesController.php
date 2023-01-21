<?php

namespace App\Http\Controllers;

use App\Models\BookDuration;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookFilesController extends Controller
{
    public function addBookFilesPage(Request $request) {
        $bookId = $request->book;
        $title = Books::all()->where('id', $bookId)->first()->title;
        $json = json_encode(['id' => $bookId, 'title' => $title]);
        return view('book views/book elements/upload-files', ['book' => $json, 'bookId' => $bookId]);
    }

    public function addBookFiles(Request $request) {
        $title = $request->title;
        $request->file('book')->storeAs($title, $request->book->getClientOriginalName(), 's3');
    }
    
    public function deleteDirectory(Request $request) {
        $title = $request->title;
        $bookId = Books::all()->where('title', $title)->first()->id;
        BookDuration::where('book_id', $bookId)->delete();
        Storage::disk('s3')->deleteDirectory('/' . $title);
    }

    public function editSelectedBookFiles(Request $request) {
        $bookId = $request->book;
        $book = Books::all()->where('id', '=', $bookId)->first();
        $json = json_encode(['id' => $bookId, 'title' => $book->title]);
        return view('book views/book elements/upload-files', ['book' => $json, 'bookId' => $bookId]);
    }

    public function getFilesJson(Request $request) {
        $bookId = $request->book;
        $book = null;
        $book = Books::all()->where('id', $bookId)->first();
        $files = [];
        if ($book) {    
            $files = Storage::disk('s3')->files($book->title);
        }

        return [
            'result' => $files
        ];
    }

    public function setBookDuration(Request $request) {
        $bookId = $request->book;
        $duration = $request->duration;
        $form = [
            'book_id' => $bookId,
            'duration' => $duration,
        ];

        BookDuration::create($form);
        return redirect('/book/' . $bookId);
    }
}
