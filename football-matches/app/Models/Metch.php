<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metch extends Model
{
    use HasFactory;

    protected $fillable = ['home_team_id', 'guest_team_id', 'result', 'date'];


    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function guestTeam()
    {
        return $this->belongsTo(Team::class, 'guest_team_id');
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'metch_player');
    }
}
