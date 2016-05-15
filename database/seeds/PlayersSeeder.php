<?php

use Illuminate\Database\Seeder;
use App\Player;

class PlayersSeeder extends Seeder
{
    public $baseUrl = 'https://br75.tribalwars.com.br/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playersFile = file_get_contents($this->baseUrl .'map/player.txt');
        $arrayPlayers = explode("\n", $playersFile);

        foreach ($arrayPlayers as $player) {

            $infoPlayer = explode(",",$player);

            Player::create([
                'id' => $infoPlayer[0],
                'name' => $infoPlayer[1],
                'points' => $infoPlayer[4],
                'rank' => $infoPlayer[5]
            ]);
        }
    }
}
