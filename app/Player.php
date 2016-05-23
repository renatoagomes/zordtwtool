<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'id',
        'name',
        'tribo_id',
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

    /**
     * Um player pode estar em uma tribo
     */
    public function tribo()
    {
        return $this->belongsTo('App\Tribo');
    }

    /**
     * Acessor para vila, quando o usuario tiver apenas 1
     */
    public function getVilaAttribute()
    {
        return $this->vilas->first();
    }



}
