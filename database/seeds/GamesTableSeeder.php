<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();

        // Get Players
        /* $p1 = User::findOrFail(1); */
        /* $p2 = User::findOrFail(3); */
        /* $p3 = User::findOrFail(4); */

        Game::create(array(
            'player1_id' => 1,
            'player2_id' => 3,
            'status' => 'FIRST',
            'msg_result1' => "Première mi-temps",
            'msg_result2' => "Deuxième mi-temps"
        ));

        Game::create(array(
            'player1_id' => 4,
            'player2_id' => 1,
            'status' => 'FIRST',
            'msg_result1' => "Première mi-temps",
            'msg_result2' => "Deuxième mi-temps"
        ));
        Game::create(array(
            'player1_id' => 1,
            'player2_id' => 4,
            'status' => 'FIRST',
            'msg_result1' => "Première mi-temps",
            'msg_result2' => "Deuxième mi-temps"
        ));
                
    }
}
