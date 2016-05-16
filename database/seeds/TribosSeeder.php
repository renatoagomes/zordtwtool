<?php

use Illuminate\Database\Seeder;
use App\Tribo;

class TribosSeeder extends Seeder
{

    public $baseUrl = 'https://br75.tribalwars.com.br/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tribosFile = file_get_contents($this->baseUrl .'map/ally.txt');
        $arrayTribos = explode("\n", $tribosFile);

        foreach ($arrayTribos as $tribo) {

            $infoTribo = explode(",", $tribo);

            Tribo::create([
                'id' => $infoTribo[0],
                'name' => $infoTribo[1],
                'tag' => $infoTribo[2],
                'members' => $infoTribo[3],
                'villages' => $infoTribo[4],
                'points' => $infoTribo[5],
                'all_points' => $infoTribo[6],
                'rank' => $infoTribo[7]
            ]);
        }
    }
}
