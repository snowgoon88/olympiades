<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Game;
use App\User;
use App\Configuration;
use App\Http\Requests\ConfPostRequest;

class TestController extends Controller
{
    public function __construct()
    {
        $this->gc = new GameController;
    }
    public function all_game()
    {
        $games = Game::all();
        return view('test.game_all', ['games' => $games]);
    }
    public function rules()
    {
        return view('test.rules');
    }
    public function show_game($gid)
    {
        $game = Game::findOrFail($gid);
        return view('test.game_show', ['game' => $game]);
    }
    public function play_game_admin($pid, $gid)
    {
        $player = User::findOrFail($pid);
        $game = Game::findOrFail($gid);
        $pos1 = ($game->player1_id == $player->id);
        
        return view('test.game_play', ['game' => $game, 'player'=>$player, 'pos1' => $pos1]);
    }
    /** Create a new configuration for a player */
    public function add_configuration(ConfPostRequest $request, $pid, $gid)
    {
        // Validation is done inside ConfPostRequest
        

        // TO DEBUG
        $conf = Configuration::create($request->all());
        //TEST Debugbar::info( "created conf id=".$conf->id );
        
        $player = User::findOrFail($pid);
        $game = Game::findOrFail($gid);
        if( $player->id == $game->player1_id ) {
            if( $game->first1 == 0 ) {
                // First Half
                $game->first1 = $conf->id;
                $game->msg_status = "Première mi-temps";
            }
            else {
                $game->second1 = $conf->id;
                $game->msg_status = "Seconde mi-temps";
            }
        }
        else {
            if( $game->first2 == 0 ) {
                // FIrst Half
                $game->first2 = $conf->id;
                $game->msg_status = "Première mi-temps";
            }
            else {
                $game->second2 = $conf->id;
                $game->msg_status = "Seconde mi-temps";
            }
        }
        $game->save();

        if( $game->status == 'FIRST'
            and $game->first1 != 0 and $game->first2 != 0 ) {
            $this->gc->run_first_period( $game->id );
        }
        else if( $game->status == 'SECOND'
            and $game->second1 != 0 and $game->second2 != 0 ) {
            $this->gc->run_second_period( $game->id );
        }

        //DEBUG return;
        return redirect()->action( 'TestController@show_game', ['gid'=>$game->id]);
        //return 'Conf id='.$conf->id.' created';
    }
    public function reset_game($gid)
    {
        $game = Game::findOrFail($gid);

        $game->status = 'FIRST';
        if( $game->first1 != 0 ) {
            $game->conf11->delete(); $game->first1 = 0;
        }
        if( $game->first2 != 0 ) {
            $game->conf21->delete(); $game->first2 = 0;
        }
        if( $game->second1 != 0 ) {
            $game->conf12->delete(); $game->second1 = 0;
        }
        if( $game->second2 != 0 ) {
            $game->conf22->delete(); $game->second2 = 0;
        }
        $game->score1 = 0;
        $game->score2 = 0;
        $game->msg_status = "-";
        $game->msg_result1 = "Première mi-temps";
        $game->msg_result2 = "Deuxième mi-temps";
        $game->save();
        return redirect()->action( 'TestController@all_game', []);
    }
}
