<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'id',
        'name',
        'points',
        'rank',
    ];


    /**
     * Um Player tem muitas Vilas
     */
    public function vilas()
    {
        return $this->hasMany('App\Vila');
    }


}
