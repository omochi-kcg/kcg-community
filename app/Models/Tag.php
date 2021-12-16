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
        '作業',
        '通話',
        '初心者歓迎',
        'まったり'
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
