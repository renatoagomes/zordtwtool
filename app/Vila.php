<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vila extends Model
{
    protected $fillable = [
        'id',
        'name',
        'x',
        'y',
        'points',
        'rank',
        'player_id',
    ];
    //
}
