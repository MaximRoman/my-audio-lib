<?php

namespace App\Http\Controllers;

use App\Models\Readers;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function createReader(Request $request) {
        $form = $request->validate([
            'reader' => ['required', 'max:255']
        ]);

        Readers::create($form);
        return redirect('/add-book/select-reader');
    }
}
