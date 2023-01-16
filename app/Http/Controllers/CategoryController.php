<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function addCategory() {
        return view('book views/category/add-category');
    }

    public function createCategory(Request $request) {
        $form = $request->validate([
            'category' => ['required', 'unique:categories', 'max:255'],
            'temp_category' => ['required', 'unique:categories', 'max:255'],
        ]);

        Categories::create($form);
        return redirect('/add-book/select-category');
    }

    public function selectCategory() {
        $categories = Categories::all();

        return view('book views/category/select-category', ['categories' => $categories]);
    }

    public function selectBookCategory(Request $request) {
        $categories = $request->categories;

        Session::put('bookCategories', $categories);

        return redirect('/add-book');
    }

    public function editSelectedCategory(Request $request) {
        $bookId = $request->book;
        $categories = Categories::all();

        return view('book views/category/select-category', ['categories' => $categories, 'bookId' => $bookId]);
    }

    public function editSelectedBookCategory(Request $request) {
        $bookId = $request->book;
        $categories = $request->categories;
        $this->updateBookJoin(BookCategory::class, $bookId, 'category_id', $categories);
        return redirect('/edit-book/' . $bookId);
    }
}
