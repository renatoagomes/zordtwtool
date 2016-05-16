<?php

use Illuminate\Database\Seeder;
use App\Vila;

class VilasSeeder extends Seeder
{

    public $baseUrl = 'https://br75.tribalwars.com.br/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vilasFile = file_get_contents($this->baseUrl .'map/village.txt');
        $arrayVilas = explode("\n", $vilasFile);

        foreach ($arrayVilas as $vila) {

            $infoVila = explode(",", $vila);

            Vila::create([
                'id' => $infoVila[0],
                'name' => $infoVila[1],
                'x' => $infoVila[2],
                'y' => $infoVila[3],
                'player_id' => ($infoVila[4] ? $infoVila[4] : null),
                'points' => $infoVila[5],
                'rank' => $infoVila[6]
            ]);
        }
    }
}
