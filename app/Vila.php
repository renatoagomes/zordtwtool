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

    /**
     * Metodo para retornar X vilas para farm
     */
    public function getFarm($numAtks, $range=10)
    {
        $vilas = $this->getVilasParaFarm($range);
        $playerVila = Vila::where('player_id', 2335680)->get()->first();

        while ($vilas->count() < $numAtks) {
            $range+=5;
            $vilas = $this->getVilasParaFarm($range);
        }

        $vilas->each(function($vila) use ($playerVila) {
            $vila->distancia = $vila->getDistanciaFrom($playerVila);
        });

        $vilasByDistancia = $vilas->sortBy('distancia');
        while($vilasByDistancia->count() > $numAtks) {

            $vilasByDistancia->pop();

        }


        return $vilasByDistancia;
    }


    /**
     * Metodo para pegar a até uma distancia de uma vila
     */
    public function getDistanciaFrom($vila)
    {
        return number_format(sqrt(pow(($this->x - $vila->x),2) + pow(($this->y - $vila->y),2)),2);
    }

    /**
     * Acessor para as coordenadas da vila de maneira amigavel
     */
    public function getCoordAmigavelAttribute()
    {
        return "(".$this->x.")|(".$this->y.")";
    }


}
