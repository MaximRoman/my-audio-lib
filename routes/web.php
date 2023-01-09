<?php

use App\Http\Controllers\AddBookController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookFilesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeleteBookController;
use App\Http\Controllers\EditBookController;
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

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/home', 'home')->name('home');
            Route::get('/add-author', 'addAuthor')->name('addAuthor');
            Route::get('/add-reader', 'addReader')->name('addReader');
            Route::get('/add-series', 'addSeries')->name('addSeries');
            Route::get('/add-category', 'addCategory')->name('addCategory');
        });
    
        Route::controller(BookController::class)->group(function () {
            Route::get('/book/{book}', 'showBook')->name('showBook');
            Route::get('/add-book/select-title', 'selectTitle')->name('selectTitle');
            Route::post('/add-book/select-title', 'selectBookTitle')->name('selectBookTitle');
            Route::get('/add-book/select-year', 'selectYear')->name('selectYear');
            Route::post('/add-book/select-year', 'selectBookYear')->name('selectBookYear');
            Route::get('/add-book/select-description', 'selectDescription')->name('selectDescription');
            Route::post('/add-book/select-description', 'selectBookDescription')->name('selectBookDescription');
        });
        
        Route::controller(AddBookController::class)->group(function () {
            Route::get('/add-book', 'addBook')->name('addBook');
            Route::post('/create-book', 'createBook')->name('createBook');
        });
        
        Route::controller(EditBookController::class)->group(function () {
            Route::get('/edit-book/{book}', 'editBook')->name('editBook');
            Route::get('/edit-book/{book}/select-title', 'editTitle')->name('editTitle');
            Route::post('/edit-book/{book}/select-book-title', 'editBookTitle')->name('editBookTitle');
            Route::get('/edit-book/{book}/select-year', 'editYear')->name('editYear');
            Route::post('/edit-book/{book}/select-book-year', 'editBookYear')->name('editBookYear');
            Route::get('/edit-book/{book}/select-description', 'editDescription')->name('editDescription');
            Route::post('/edit-book/{book}/select-book-description', 'editBookDescription')->name('editBookDescription');
        });
        
        Route::controller(DeleteBookController::class)->group(function () {
            Route::delete('/delete-book/{book}', 'deleteBook')->name('deleteBook');
        });
        
        Route::controller(BookFilesController::class)->group(function () {
            Route::post('/add-book/create-url', 'addBookFiles')->name('addBookFiles');
            Route::post('/add-book/delete-directory', 'deleteDirectory')->name('deleteDirectory');
            Route::get('/add-book/{book}/upload-files', 'addBookFilesPage')->name('addBookFilesPage');
            Route::get('/edit-book/{book}/upload-files', 'editSelectedBookFiles')->name('editSelectedBookFiles');
        });
        
        Route::controller(AuthorController::class)->group(function () {
            Route::get('/add-book/select-author', 'selectAuthor')->name('selectAuthor');
            Route::post('/add-book/select-author', 'selectBookAuthor')->name('selectBookAuthor');
            Route::get('/edit-book/{book}/select-author', 'editSelectedAuthor')->name('editSelectedAuthor');
            Route::post('/edit-book/{book}/select-book-author', 'editSelectedBookAuthor')->name('editSelectedBookAuthor');
            Route::post('/create-author', 'createAuthor')->name('createAuthor');
        });
        
        Route::controller(ImageController::class)->group(function () {
            Route::get('/add-book/select-image', 'selectImage')->name('selectImage');
            Route::post('/add-book/select-image/{image}', 'selectBookImage')->name('selectBookImage');
            Route::get('/edit-book/{book}/select-image', 'editSelectedImage')->name('editSelectedImage');
            Route::post('/edit-book/{book}/select-book-image/{image}', 'editSelectedBookImage')->name('editSelectedBookImage');
            Route::get('/add-image', 'addImage')->name('addImage');
            Route::post('/upload-image',  'uploadImage')->name('uploadImage');
            Route::put('/upload-other-image/{image}',  'uploadOtherImage')->name('uploadOtherImage');
            Route::put('/delete-image/{image}',  'deleteImage')->name('deleteImage');
            Route::get('/edit-image/{image}',  'editImage')->name('editImage');
        });
        
        Route::controller(ReaderController::class)->group(function () {
            Route::get('/add-book/select-reader', 'selectReader')->name('selectReader');
            Route::post('/add-book/select-reader', 'selectBookReader')->name('selectBookReader');
            Route::get('/edit-book/{book}/select-reader', 'editSelectedReader')->name('editSelectedReader');  
            Route::post('/edit-book/{book}/select-book-reader', 'editSelectedBookReader')->name('editSelectedBookReader');
            Route::post('/create-reader', 'createReader')->name('createReader');    
        });
        
        Route::controller(SeriesController::class)->group(function () {
            Route::get('/add-book/select-series', 'selectSeries')->name('selectSeries');
            Route::post('/add-book/select-series', 'selectBookSeries')->name('selectBookSeries');
            Route::get('/edit-book/{book}/select-series', 'editSelectedSeries')->name('editSelectedSeries');
            Route::post('/edit-book/{book}/select-book-series', 'editSelectedBookSeries')->name('editSelectedBookSeries');
            Route::post('/create-series', 'createSeries')->name('createSeries');
        });
        
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/add-book/select-category', 'selectCategory')->name('selectCategory');
            Route::post('/add-book/select-category', 'selectBookCategory')->name('selectBookCategory');
            Route::get('/edit-book/{book}/select-category', 'editSelectedCategory')->name('editSelectedCategory');
            Route::post('/edit-book/{book}/select-book-category', 'editSelectedBookCategory')->name('editSelectedBookCategory');
            Route::post('/create-category', 'createCategory')->name('createCategory');
        });
        
        Route::controller(LikeSysController::class)->group(function () {
            Route::get('/set-book-grade/{book}/{grade}', 'setBookGrade')->name('setBookGrade')->middleware('auth');
        });
        
        Route::controller(AdminsController::class)->group(function () {
            Route::post('/admins', 'shoeAdmins')->name('shoeAdmins');
        });
        
        Route::controller(CommentController::class)->group(function () {
            Route::post('/add-comment/{book}', 'addComment')->name('addComment');
            Route::post('/search-comments', 'searchComments')->name('searchComments');
        });
    });
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/book/{book}', 'showBook')->name('showBook');
});

Route::controller(CommentController::class)->group(function () {
    Route::get('/get-comments/{book}', 'getComments')->name('getComments');
    Route::post('/search-comments', 'searchComments')->name('searchComments');
});
        
Route::controller(LikeSysController::class)->group(function () {
    Route::get('/get-book-grades/{book}', 'getBookGrades')->name('getBookGrades');
});