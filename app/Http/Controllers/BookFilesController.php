<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookFilesController extends Controller
{
    public function addBookFilesPage(Request $request) {
        $bookId = $request->book;
        $title = Books::all()->where('id', $bookId)->first()->title;
        $json = json_encode(['id' => $bookId, 'title' => $title]);
        return view('book views/book elements/upload-files', ['book' => $json]);
    }

    public function addBookFiles(Request $request) {
        $title = $request->title;
        $request->file('book')->storeAs($title, $request->book->getClientOriginalName(), 'public');
    }

    public function deleteDirectory(Request $request) {
        $title = $request->title;
        Storage::disk('public')->deleteDirectory('/' . $title);
    }

    public function editSelectedBookFiles(Request $request) {
        $bookId = $request->book;
        $book = Books::all()->where('id', '=', $bookId)->first();
        $json = json_encode(['id' => $bookId, 'title' => $book->title]);
        return view('book views/book elements/upload-files', ['book' => $json]);
    }
}
