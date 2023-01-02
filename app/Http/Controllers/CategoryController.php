<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request) {
        $form = $request->validate([
            'category' => ['required', 'unique:categories', 'max:255'],
            'temp_category' => ['required', 'unique:categories', 'max:255'],
        ]);

        Categories::create($form);
        return redirect('/add-book/select-category');
    }
}
