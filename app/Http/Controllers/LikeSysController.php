<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeSysController extends Controller
{
    public function setBookGrade(Request $request) {
        $user = Auth::user()->id;
        $bookId = $request->book;
        $grade = $request->grade;

        $form = [
            'book_id' => $bookId,
            'user_id' => $user,
            'status' => $grade,
        ];

        $grades = Grades::all()->where('book_id', $bookId)->where('user_id', $user)->first();
        
        if (!$grades) {
            Grades::create($form);
        } else {
            if ($grades->status == $grade) {
                $grades->delete();
            } else {
                $grades->update($form);
            }
        }
    }

    public function getBookGrades(Request $request) {
        $bookId = $request->book;
        $grades = Grades::where('book_id', $bookId)->get('status');
        $comments = Comments::all()->where('book_id', $bookId);
        $usersGrades = null;
        if (Auth::user()) {
            if (Grades::all()->where('book_id', $bookId)->where('user_id', Auth::user()->id)->first()) {
                $usersGrades = Grades::all()->where('book_id', $bookId)->where('user_id', Auth::user()->id)->first()->status;
            }
        }
        return [
            'grades' => $grades,
            'usersGrades' => $usersGrades,
            'comments' => count($comments)
        ];
    }
}
