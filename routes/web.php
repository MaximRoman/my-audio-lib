<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditBookController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeSysController;
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
Route::get('/book/{book}', [BookController::class, 'showBook'])->name('showBook');
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
Route::get('/add-book/{book}/upload-files', [BookController::class, 'addBookFilesPage'])->name('addBookFilesPage');


Route::get('/edit-book/{book}', [EditBookController::class, 'editBook'])->name('editBook');
Route::get('/edit-book/{book}/select-image', [EditBookController::class, 'editImage'])->name('editImage');
Route::post('/edit-book/{book}/select-book-image/{image}', [EditBookController::class, 'editBookImage'])->name('editBookImage');
Route::get('/edit-book/{book}/select-title', [EditBookController::class, 'editTitle'])->name('editTitle');
Route::post('/edit-book/{book}/select-book-title', [EditBookController::class, 'editBookTitle'])->name('editBookTitle');
Route::get('/edit-book/{book}/select-author', [EditBookController::class, 'editAuthor'])->name('editAuthor');
Route::post('/edit-book/{book}/select-book-author', [EditBookController::class, 'editBookAuthor'])->name('editBookAuthor');
Route::get('/edit-book/{book}/select-reader', [EditBookController::class, 'editReader'])->name('editReader');
Route::post('/edit-book/{book}/select-book-reader', [EditBookController::class, 'editBookReader'])->name('editBookReader');
Route::get('/edit-book/{book}/select-year', [EditBookController::class, 'editYear'])->name('editYear');
Route::post('/edit-book/{book}/select-book-year', [EditBookController::class, 'editBookYear'])->name('editBookYear');
Route::get('/edit-book/{book}/select-series', [EditBookController::class, 'editSeries'])->name('editSeries');
Route::post('/edit-book/{book}/select-book-series', [EditBookController::class, 'editBookSeries'])->name('editBookSeries');
Route::get('/edit-book/{book}/select-category', [EditBookController::class, 'editCategory'])->name('editCategory');
Route::post('/edit-book/{book}/select-book-category', [EditBookController::class, 'editBookCategory'])->name('editBookCategory');
Route::get('/edit-book/{book}/select-description', [EditBookController::class, 'editDescription'])->name('editDescription');
Route::post('/edit-book/{book}/select-book-description', [EditBookController::class, 'editBookDescription'])->name('editBookDescription');
Route::get('/edit-book/{book}/upload-files', [EditBookController::class, 'editBookFiles'])->name('editBookFiles');


Route::get('/add-image', [ImageController::class, 'addImage'])->name('addImage');
Route::post('/upload-image', [ImageController::class,  'uploadImage'])->name('uploadImage');
Route::put('/upload-other-image/{image}', [ImageController::class,  'uploadOtherImage'])->name('uploadOtherImage');
Route::put('/delete-image/{image}', [ImageController::class,  'deleteImage'])->name('deleteImage');
Route::get('/edit-image/{image}', [ImageController::class,  'editImage'])->name('editImage');

Route::get('/add-author', [HomeController::class, 'addAuthor'])->name('addAuthor');
Route::post('/create-author', [AuthorController::class, 'createAuthor'])->name('createAuthor');

Route::get('/add-reader', [HomeController::class, 'addReader'])->name('addReader');
Route::post('/create-reader', [ReaderController::class, 'createReader'])->name('createReader');

Route::get('/add-series', [HomeController::class, 'addSeries'])->name('addSeries');
Route::post('/create-series', [SeriesController::class, 'createSeries'])->name('createSeries');

Route::get('/add-category', [HomeController::class, 'addCategory'])->name('addCategory');
Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('createCategory');

Route::post('/add-book/create-url', [BookController::class, 'addBookFiles'])->name('addBookFiles');
Route::post('/add-book/delete-directory', [BookController::class, 'deleteDirectory'])->name('deleteDirectory');

Route::delete('/delete-book/{book}', [BookController::class, 'deleteBook'])->name('deleteBook');


Route::get('/set-book-grade/{book}/{grade}', [LikeSysController::class, 'setBookGrade'])->name('setBookGrade')->middleware('auth');
Route::get('/get-book-grades/{book}', [LikeSysController::class, 'getBookGrades'])->name('getBookGrades');

Route::post('/admins', [BookController::class, 'shoeAdmins'])->name('shoeAdmins');