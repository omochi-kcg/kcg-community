<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  const CATEGORIES = [
    'コミュニティ',
    '授業',
    'サークル',
    'アニメ・マンガ',
    'ゲーム',
    'その他'
  ];

  public function discord_servers()
  {
    return $this->hasMany(DiscordServer::class);
  }
}
