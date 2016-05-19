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

    /**
     * Uma vila pode pertencer a um player
     */
    public function player()
    {
        return $this->belongsTo('App\Player');
    }

    /**
     * Retorna as n vilas dentro de um range
     * @param $range
     */
    public function getVilasProximas($range)
    {
       $vilas = Vila::where('x', '<=', ($this->x + $range))
            ->where('x', '>=', ($this->x - $range))
            ->where('y', '>=', ($this->y - $range))
            ->where('y', '<=', ($this->y + $range))->get();

        return $vilas;
    }


    /**
     * Retorna as n vilas dentro de um range
     * @param $range
     */
    public function getVilasParaFarm($range)
    {
        $vilas = Vila::where(function ($query) use ($range) {
           $query->where('x', '<=', ($this->x + $range))
               ->where('x', '>=', ($this->x - $range))
               ->where('y', '>=', ($this->y - $range))
               ->where('y', '<=', ($this->y + $range));

        })->where(function ($query) {
           $query->where('name', 'Aldeia-bonus')
               ->orWhere('name', 'Aldeia+de+b%C3%A1rbaros');
        })->get();

        return $vilas;
    }


}
