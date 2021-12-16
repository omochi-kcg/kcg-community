<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    const TAGS = [
        '雑談',
        '交流',
        '作業',
        '通話',
        'まったり',
        '初心者歓迎',
        '誰でも歓迎',
        'プログラミング',
        'PC',
        'お絵描き',
        '音楽'
    ];

    protected $fillable = [
        'name',
        'discord_server_id',
        'tag_id',
    ];

    public function discord_servers()
    {
        return $this->belongsToMany(DiscordServer::class);
    }
}
