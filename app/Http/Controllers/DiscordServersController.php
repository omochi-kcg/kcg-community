<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscordServersEdit;
use App\Http\Requests\DiscordServersEditRequest;
use App\Http\Requests\DiscordServersStoreRequest;
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
        $categories = Category::all();
        return view('discord-servers.create', compact('categories'));
    }

    public function store(DiscordServersStoreRequest $request)
    {
    }

    public function edit($id)
    {
        $server = DiscordServer::findOrFail($id);
        $categories = Category::all();
        return view('discord-servers.edit', compact('server', 'categories'));
    }

    public function update(DiscordServersEditRequest $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
