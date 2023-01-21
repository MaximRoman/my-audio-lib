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
        $comments = Comments::join("users", "book_comments.user_id", "=", "users.id")
                            ->orderBy("created_at", "desc")
                            ->where("book_id", $bookId)
                            ->get([
                                "book_comments.created_at",
                                "book_id",
                                "book_comments.id",
                                'book_comments.user_id',
                                "name",
                                "comment",
                            ]);
        return [
            "comments" => $comments
        ];
    }

    public function searchComments(Request $request) {
        $bookId = $request->book;
        $comment = $request->comment;
        $comments = Comments::join("users", "book_comments.user_id", "=", "users.id")
                            ->orderBy("created_at", "desc")
                            ->whereRaw("book_id = " . $bookId . " AND (comment LIKE ('%" . $comment . "%') OR name LIKE ('%" . $comment . "%'))")
                            ->get([
                                "book_comments.created_at",
                                "book_id",
                                "book_comments.id",
                                "name",
                                "comment",
                            ]);
        return [
            "comments" => $comments
        ];
    }
//  
    public function addComment(Request $request) {
        $bookId = $request->book;
        $userId = Auth::user()->id;
        $comment = $request->comment;
        
        $form = [
            "book_id" => $bookId,
            "user_id" => $userId,
            "comment" => $comment,
        ];

        $id = Comments::create($form)->id;
    }

    public function deleteComment(Request $request) {
        $commentId = $request->comment;
        $userId = $request->user;
        Comments::where('id', $commentId)->where('user_id', $userId)->delete();
    }
}
