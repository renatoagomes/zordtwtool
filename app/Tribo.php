<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribo extends Model
{
    protected $fillable = [
        'id',
        'name',
        'tag',
        'members',
        'villages',
        'points',
        'all_points',
        'rank',
    ];

    /**
     * Uma Tribo tem muitos membros
     */
    public function membros()
    {
        return $this->hasMany('App\Player');
    }
}
