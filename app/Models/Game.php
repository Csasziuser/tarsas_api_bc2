<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title', 'max_player', 'difficulty'];

    public function sessions(){
        return $this->hasMany(Session::class);
    }
}
