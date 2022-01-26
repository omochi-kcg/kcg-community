<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Board $board)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->board_id = $board->id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()
            ->route('boards.show', $board);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('boards.show', $comment->board);
    }
}
