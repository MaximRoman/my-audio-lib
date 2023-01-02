<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function createAuthor(Request $request) {
        $form = $request->validate([
            'author' => ['required', 'unique:authors', 'max:255']
        ]);

        Authors::create($form);
        return redirect('/add-book/select-author');
    }
}
