<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\SeriesController;

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

Route::get('/add-book', [BookController::class, 'addBook'])->name('addBook');
Route::get('/add-book/select-image', [BookController::class, 'selectImage'])->name('selectImage');
Route::post('/add-book/select-image/{image}', [BookController::class, 'selectBookImage'])->name('selectBookImage');
Route::get('/add-book/select-title', [BookController::class, 'selectTitle'])->name('selectTitle');
Route::post('/add-book/select-title', [BookController::class, 'selectBookTitle'])->name('selectBookTitle');
Route::get('/add-book/select-author', [BookController::class, 'selectAuthor'])->name('selectAuthor');
Route::post('/add-book/select-author', [BookController::class, 'selectBookAuthor'])->name('selectBookAuthor');
Route::get('/add-book/select-reader', [BookController::class, 'selectReader'])->name('selectReader');
Route::post('/add-book/select-reader', [BookController::class, 'selectBookReader'])->name('selectBookReader');
Route::get('/add-book/select-year', [BookController::class, 'selectYear'])->name('selectYear');
Route::post('/add-book/select-year', [BookController::class, 'selectBookYear'])->name('selectBookYear');
Route::get('/add-book/select-series', [BookController::class, 'selectSeries'])->name('selectSeries');
Route::post('/add-book/select-series', [BookController::class, 'selectBookSeries'])->name('selectBookSeries');
Route::get('/add-book/select-category', [BookController::class, 'selectCategory'])->name('selectCategory');
Route::post('/add-book/select-category', [BookController::class, 'selectBookCategory'])->name('selectBookCategory');
Route::get('/add-book/select-description', [BookController::class, 'selectDescription'])->name('selectDescription');
Route::post('/add-book/select-description', [BookController::class, 'selectBookDescription'])->name('selectBookDescription');

Route::post('/create-book', [BookController::class, 'createBook'])->name('createBook');

Route::get('/edit-book', [HomeController::class, 'editBook'])->name('editBook');

Route::get('/add-image', [BookController::class, 'addImage'])->name('addImage');
Route::post('/upload-image', [ImageController::class,  'uploadImage'])->name('uploadImage');
Route::put('/upload-other-image/{image}', [ImageController::class,  'uploadOtherImage'])->name('uploadOtherImage');
Route::put('/delete-image/{image}', [ImageController::class,  'deleteImage'])->name('deleteImage');
Route::get('/edit-image/{image}', [HomeController::class,  'editImage'])->name('editImage');

Route::get('/add-author', [HomeController::class, 'addAuthor'])->name('addAuthor');
Route::post('/create-author', [AuthorController::class, 'createAuthor'])->name('createAuthor');

Route::get('/add-reader', [HomeController::class, 'addReader'])->name('addReader');
Route::post('/create-reader', [ReaderController::class, 'createReader'])->name('createReader');

Route::get('/add-series', [HomeController::class, 'addSeries'])->name('addSeries');
Route::post('/create-series', [SeriesController::class, 'createSeries'])->name('createSeries');

Route::get('/add-category', [HomeController::class, 'addCategory'])->name('addCategory');
Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('createCategory');


Route::get('/edit-book/edit-info', [HomeController::class,  'editBookInfo'])->name('editBookInfo');
Route::get('/edit-book/upload-image', [HomeController::class,  'uploadBookImage'])->name('editBookImage');
Route::get('/edit-book/edit-authors', [HomeController::class,  'editBookAuthors'])->name('editBookAuthors');
Route::get('/edit-book/edit-readers', [HomeController::class,  'editBookReaders'])->name('editBookReaders');
Route::get('/edit-book/edit-categories', [HomeController::class,  'editBookCategories'])->name('editBookCategories');
Route::get('/edit-book/upload-files', [HomeController::class,  'uploadFiles'])->name('editBookFiles');

Route::delete('/delete-book/{book}', [BookController::class, 'deleteBook'])->name('deleteBook');

Route::get('/add-book/upload-files', [HomeController::class, 'uploadFiles'])->name('uploadFiles');



// Route::post('/add-author', [App\Http\Controllers\HomeController::class, 'addAuthor'])->name('addAuthor');


