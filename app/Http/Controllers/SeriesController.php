<?php

namespace App\Http\Controllers;

use App\Models\BookSeries;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SeriesController extends Controller
{
    public function createSeries(Request $request) {
        $form = $request->validate([
            'series' => ['required', 'unique:series', 'max:255']
        ]);

        Series::create($form);
        return redirect('/add-book/select-series');
    }

    public function selectSeries() {
        $series = Series::all();

        return view('book views/series/select-series', ['series' => $series]);
    }

    public function selectBookSeries(Request $request) {
        $series = $request->series;

        Session::put('bookSeries', $series);

        return redirect('/add-book');
    }

    public function editSelectedSeries(Request $request) {
        $bookId = $request->book;
        $series = Series::all();

        return view('book views/series/select-series', ['series' => $series, 'bookId' => $bookId]);
    }

    public function editSelectedBookSeries(Request $request) {
        $bookId = $request->book;
        $series = [$request->series];
        $this->updateBookJoin(BookSeries::class, $bookId, 'series_id', $series);

        return redirect('/edit-book/' . $bookId);
    }
}
