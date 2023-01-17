<?php

namespace App\Http\Controllers;

use App\Models\BookSeries;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SeriesController extends Controller
{
    public function addSeries(Request $request) {
        $bookId = $request->book;

        return view('book views/series/add-series', ['bookId' => $bookId]);
    }

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
        $seriesChecked = json_decode($request->checked);

        if (count($seriesChecked) > 0) {
            Session::pull('bookSeries');
            Session::put('bookSeries', $seriesChecked[0]);
        } else {
            Session::pull('bookSeries');
        }
        return [
            'result' => Session::get('bookSeries'),
        ];
    }

    public function editSelectedSeries(Request $request) {
        $bookId = $request->book;
        $series = Series::all();

        return view('book views/series/select-series', ['series' => $series, 'bookId' => $bookId]);
    }

    public function editSelectedBookSeries(Request $request) {
        $bookId = $request->book;
        $series = [];
        if (Session::get('bookSeries')) {
            $series = [Session::get('bookSeries')];
        }
        
        $editBook = new EditBookController();
        $editBook->updateBookJoin(BookSeries::class, $bookId, 'series_id', $series);

        return redirect('/edit-book/' . $bookId);
    }
}
