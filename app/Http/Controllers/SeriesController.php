<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function createSeries(Request $request) {
        $form = $request->validate([
            'series' => ['required', 'unique:series', 'max:255']
        ]);

        Series::create($form);
        return redirect('/add-book/select-series');
    }
}
