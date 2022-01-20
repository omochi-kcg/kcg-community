<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('self')->only(['edit', 'update']);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user,)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $user->name = $request->name;
        $user->save();

        return redirect()
            ->route('discord-servers.index')
            ->with([
                'message' => 'ユーザー情報を更新しました',
                'status' => 'success',
            ]);
    }
}
