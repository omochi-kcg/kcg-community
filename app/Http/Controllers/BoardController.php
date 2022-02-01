<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Http\Requests\BoardRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner:board')->only(['edit', 'update', 'destroy']);
    }

    public function board()
    {
        $boards = Board::latest()->get();

        return view('board')
            ->with(['boards' => $boards]);
    }

    public function show(Board $board)
    {
        return view('boards.show')
            ->with(['board' => $board]);
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(BoardRequest $request)
    {
        $board = new Board();
        $board->user_id = Auth::id();
        $board->title = $request->title;
        $board->description = $request->description;
        $board->save();

        // $post = new Post();
        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->save();

        return redirect()
            ->route('boards.board');
    }

    public function edit(Board $board)
    {
        return view('boards.edit')
            ->with(['board' => $board]);
    }

    public function update(BoardRequest $request, Board $board)
    {
        $board->user_id = Auth::id();
        $board->title = $request->title;
        $board->description = $request->description;
        $board->save();

        return redirect()
            ->route('boards.show', $board);
    }

    public function destroy(Board $board)
    {
        foreach ($board->comments as $comment) {
            $comment->delete();
        }

        $board->delete();

        return redirect()
            ->route('boards.board');
    }
}
