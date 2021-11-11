<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordServers extends Model
{
    use HasFactory;

    public function user() {
		return $this->belongsTo(User::class);
	}

    public function category() {
		return $this->belongsTo(Categories::class);
	}

    public function tags() {
		return $this->hasMany(Tags::class);
	}
}
