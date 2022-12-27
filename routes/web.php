<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'verify' => true
]);

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/add-book', [HomeController::class, 'addBook'])->name('addBook');
Route::get('/add-book/select-image', [HomeController::class, 'selectImage'])->name('selectImage');
Route::post('/add-book/select-image/{image}', [HomeController::class, 'selectBookImage'])->name('selectBookImage');
Route::get('/add-book/select-author', [HomeController::class, 'selectAuthor'])->name('selectAuthor');
Route::post('/add-book/select-author', [HomeController::class, 'selectBookAuthor'])->name('selectBookAuthor');
Route::get('/add-book/select-reader', [HomeController::class, 'selectReader'])->name('selectReader');
Route::post('/add-book/select-reader', [HomeController::class, 'selectBookReader'])->name('selectBookReader');


Route::post('/create-book', [BookController::class, 'createBook'])->name('createBook');

Route::get('/edit-book', [HomeController::class, 'editBook'])->name('editBook');

Route::get('/add-image', [HomeController::class, 'addImage'])->name('addImage');
Route::post('/upload-image', [ImageController::class,  'uploadImage'])->name('uploadImage');

Route::get('/add-author', [HomeController::class, 'addAuthor'])->name('addAuthor');
Route::post('/create-author', [AuthorController::class, 'createAuthor'])->name('createAuthor');


Route::get('/edit-book/edit-info', [HomeController::class,  'editBookInfo'])->name('editBookInfo');
Route::get('/edit-book/upload-image', [HomeController::class,  'uploadBookImage'])->name('editBookImage');
Route::get('/edit-book/edit-authors', [HomeController::class,  'editBookAuthors'])->name('editBookAuthors');
Route::get('/edit-book/edit-readers', [HomeController::class,  'editBookReaders'])->name('editBookReaders');
Route::get('/edit-book/edit-categories', [HomeController::class,  'editBookCategories'])->name('editBookCategories');
Route::get('/edit-book/upload-files', [HomeController::class,  'uploadFiles'])->name('editBookFiles');

Route::delete('/delete-book/{book}', [BookController::class, 'deleteBook'])->name('deleteBook');

Route::get('/add-book/upload-files', [HomeController::class, 'uploadFiles'])->name('uploadFiles');



// Route::post('/add-author', [App\Http\Controllers\HomeController::class, 'addAuthor'])->name('addAuthor');


