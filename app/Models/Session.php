<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions_2';

    protected $fillable = ['game_id', 'player_id', 'scheduled_at', 'location'];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function player(){
        return $this->belongsTo(Player::class);
    }
}
