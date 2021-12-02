<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscordServersEditRequest;
use App\Http\Requests\DiscordServersStoreRequest;
use App\Models\Category;
use App\Models\DiscordServer;
use App\Models\Tag;

class DiscordServersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $categories = Category::all();
        $tags = Tag::withCount('discord_servers')->orderBY('discord_servers_count', 'desc')->orderBy('name', 'asc')->limit(5)->get();
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
