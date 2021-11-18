<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DiscordServer;
use Illuminate\Http\Request;

class DiscordServersController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Category::limit(5)->get();
        $servers = DiscordServer::all();
        return view('discord-servers.index', compact('categories', 'tags', 'servers'));
    }

    public function create()
    {
        return view('discord-servers.create');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        $server = DiscordServer::findOrFail($id);
        return view('discord-servers.edit', compact('server'));
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
