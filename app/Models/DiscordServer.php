<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'url',
        'name',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function discord_servers()
    {
        return $this->hasMany(DiscordServer::class);
    }
}
