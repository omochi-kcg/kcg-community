<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscordServersEditRequest;
use App\Http\Requests\DiscordServersStoreRequest;
use App\Models\Category;
use App\Models\DiscordServer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DiscordServersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware('owner:discord_server')->only(['edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $servers = DiscordServer::query();
        $categories = Category::withCount('discord_servers')->orderBY('discord_servers_count', 'desc')->get();
        $tags = Tag::withCount('discord_servers')->orderBY('discord_servers_count', 'desc')->orderBy('name', 'asc')->limit(5)->get();

        if ($request->has('category')) {
            $servers = $servers->where('category_id', $request->category);
        }
        if ($request->has('tag')) {
            $servers = $servers->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }
        if ($request->has('search')) {
            $servers = $servers->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('tags', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $servers = $servers->orderBy('name', 'desc')->paginate(12);

        $pagination = $servers->appends([
            'search' => $request->get('search'),
            'category' => $request->get('category'),
            'tag' => $request->get('tag'),
            'pagination' => $request->get('pagination'),
        ]);

        return view('discord-servers.index', compact('categories', 'tags', 'servers', 'pagination'));
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
                if (!is_null($request->tags)) {
                    $tagNames = array_unique(array_filter($request->tags));
                    foreach ($tagNames as $tagName) {
                        $tag = Tag::where('name', $tagName)->firstOrCreate([
                            'name' => $tagName
                        ]);
                        $tagIds[] = $tag->id;
                    }
                    $server->tags()->attach($tagIds);
                }
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('discord-servers.index')
            ->with([
                'message' => 'サーバーを作成しました。',
                'status' => 'success',
            ]);
    }

    public function edit(DiscordServer $server)
    {
        $categories = Category::all();
        return view('discord-servers.edit', compact('server', 'categories'));
    }

    public function update(DiscordServersEditRequest $request, DiscordServer $server)
    {
        try {
            DB::transaction(function () use ($request, $server) {
                $server->category_id = $request->category_id;
                $server->url = $request->url;
                $server->name = $request->name;
                $server->description = $request->description;
                $server->save();

                $tagIds = [];
                // 空白と重複を除去
                $tagNames = array_unique(array_filter($request->tags));
                foreach ($tagNames as $tagName) {
                    $tag = Tag::where('name', $tagName)->firstOrCreate([
                        'name' => $tagName
                    ]);
                    $tagIds[] = $tag->id;
                }
                $server->tags()->sync($tagIds);
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('discord-servers.index')
            ->with([
                'message' => 'サーバーを更新しました。',
                'status' => 'success',
            ]);;
    }

    public function destroy(DiscordServer $server)
    {
        try {
            DB::transaction(function () use ($server) {
                if (!is_null($server->tags)) {
                    foreach ($server->tags as $serverTag) {
                        $server->tags()->detach($serverTag->id);
                        if (Tag::where('id', $serverTag->id)->withCount('discord_servers')->value('discord_servers_count') === 0) {
                            $serverTag->delete();
                        }
                    }
                }
                $server->delete();
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('discord-servers.index')
            ->with([
                'message' => 'サーバーを削除しました。',
                'status' => 'success',
            ]);
    }

    public function about()
    {
        return view('discord-servers.about');
    }
}
