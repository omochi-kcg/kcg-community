<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscordServersEditRequest;
use App\Http\Requests\DiscordServersStoreRequest;
use App\Models\Category;
use App\Models\DiscordServer;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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
        try {
            DB::transaction(function () use ($request) {
                $server = DiscordServer::create([
                    'category_id' => $request->category_id,
                    'user_id' => Auth::id(),
                    'url' => $request->url,
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                $tagIds = [];
                // 空白と重複を除去
                $tagNames = array_unique(array_filter($request->tags));
                foreach ($tagNames as $tagName) {
                    $tag = Tag::where('name', $tagName)->firstOrCreate([
                        'name' => $tagName
                    ]);
                    $tagIds[] = $tag->id;
                }
                $server->tags()->attach($tagIds);
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('discord-servers.index');
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
