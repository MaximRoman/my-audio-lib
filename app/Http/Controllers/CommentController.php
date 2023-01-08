<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function getComments(Request $request) {
        $bookId = $request->book;
        $comments = Comments::join('users', 'book_comments.user_id', '=', 'users.id')
                            ->orderBy('created_at', 'desc')
                            ->where('book_id', $bookId)
                            ->get([
                                'book_comments.created_at',
                                'book_id',
                                'book_comments.id',
                                'name',
                                'comment',
                            ]);
        return [
            'comments' => $comments
        ];
    }

    public function addComment(Request $request) {
        $bookId = $request->book;
        $userId = Auth::user()->id;
        $comment = $request->comment;
        
        $form = [
            'book_id' => $bookId,
            'user_id' => $userId,
            'comment' => $comment,
        ];

        $id = Comments::create($form)->id;
    }
}
