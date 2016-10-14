<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

use App\Http\Requests;
use App\Configuration;
use App\User;
use App\Game;
//use Validator;
use App\Http\Requests\ConfPostRequest;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    const VAL_SHIFUMI = 1;
    public $arr_zone = ['GAUCHE','CENTRE','DROITE'];
    public function __construct()
    {
        list($usec, $sec) = explode(' ', microtime());
        $val = (float) $sec + ((float) $usec * 100000);
        srand( $val );
    }
    public function get_total( $conf )
    {
        $attG = $conf->nbattG * 3 + $conf->nbquartG * 2
            + $conf->nbdefG * 1 + $conf->nbpassG * 4;
        $defG = $conf->nbattG * 1 + $conf->nbquartG * 2 + $conf->nbdefG * 3;
        $attC = $conf->nbattC * 3 + $conf->nbquartC * 2
            + $conf->nbdefC * 1 + $conf->nbpassC * 4;
        $defC = $conf->nbattC * 1 + $conf->nbquartC * 2 + $conf->nbdefC * 3;
        $attD = $conf->nbattD * 3 + $conf->nbquartD * 2
            + $conf->nbdefD * 1 + $conf->nbpassD * 4;
        $defD = $conf->nbattD * 1 + $conf->nbquartD * 2 + $conf->nbdefD * 3;
        return array('attG'=>$attG, 'defG'=>$defG,
        'attC'=>$attC, 'defC'=>$defC,
        'attD'=>$attD, 'defD'=>$defD);
    }
    public function shifumi( $choice1, $choice2 )
    {
        if( ($choice1 == 'PAPIER' and $choice2 == 'PIERRE') or
        ($choice1 == 'CISEAUX' and $choice2 == 'PIERRE') or
        ($choice1 == 'PIERRE' and $choice2 == 'CISEAUX'))
            return "win1";
        if( ($choice2 == 'PAPIER' and $choice1 == 'PIERRE') or
        ($choice2 == 'CISEAUX' and $choice1 == 'PIERRE') or
        ($choice2 == 'PIERRE' and $choice1 == 'CISEAUX'))
            return "win2";
        return "draw";
    }
    /** Return an integer value */
    public function diff_shifumi( $choice1, $choice2 )
    {
        if( ($choice1 == 'PAPIER' and $choice2 == 'PIERRE') or
        ($choice1 == 'CISEAUX' and $choice2 == 'PIERRE') or
        ($choice1 == 'PIERRE' and $choice2 == 'CISEAUX'))
            return self::VAL_SHIFUMI;
        if( ($choice2 == 'PAPIER' and $choice1 == 'PIERRE') or
        ($choice2 == 'CISEAUX' and $choice1 == 'PIERRE') or
        ($choice2 == 'PIERRE' and $choice1 == 'CISEAUX'))
            return -self::VAL_SHIFUMI;
        return 0;
    }
    /** Solve attack, modify '$msg' */
    public function solve_attack( $val_att, $val_def,
    $sfm_att, $sfm_def, &$msg )
    {
        // Result
        $diff = rand(0,4)-2;
        $msg .= "Résolution de l'attaque. Le dé vaut ".$diff.".";

        // Valeurs des joueurs
        $msg .= " +".$val_att."(att) -".$val_def."(def) ";
        $diff += $val_att - $val_def;

        // Shifumi
        $val_sfm = $this->diff_shifumi( $sfm_att, $sfm_def);
        if( $val_sfm >= 0)
            $msg .= "+";
        $msg .= $val_sfm."(shifumi)";
        $diff += $val_sfm;

        $msg .= " = ".$diff."<br/>";
        return $diff;
    }
            
    public function run_first_period($gid)
    {
        $game = Game::findOrFail($gid);
        $conf_p1 = $game->conf11;
        $conf_p2 = $game->conf21;
        $name_p1 = $game->player1->name;
        $name_p2 = $game->player2->name;
        $val_p1 = $this->get_total( $conf_p1 );
        $val_p2 = $this->get_total( $conf_p2 );
        $score_p1 = 0;
        $score_p2 = 0;

        $msg = "";
        // first phase
        $zone = $this->arr_zone[rand(0,2)];
        $pos = 0; // Possession de la balle a win1 ou win2
        switch( $zone ) {
        case 'GAUCHE':
            // Gauche
            $msg .= "Balle atterit dans la zone GAUCHE de l'équipe ".$name_p1."<br/>";
            $msg .= $conf_p1->sfmG." vs ".$conf_p2->sfmD."<br/>";
            $res = $this->shifumi( $conf_p1->sfmG, $conf_p2->sfmD );
            break;
        case 'CENTRE':
            // Center
            $msg .= "Balle atterit dans la zone CENTRE<br/>";
            $msg .= $conf_p1->sfmC." vs ".$conf_p2->sfmC."<br/>";
            $res = $this->shifumi( $conf_p1->sfmC, $conf_p2->sfmC );
            break;
        case 'DROITE':
            // Droite
            $msg .= "Balle atterit dans la zone DROITE de l'équipe ".$name_p1."<br/>";
            $msg .= $conf_p1->sfmD." vs ".$conf_p2->sfmG."<br/>";
            $res = $this->shifumi( $conf_p1->sfmD, $conf_p2->sfmG );
            break;
        }
        if( $res == 'draw' ) {
            $msg .= "Après égalité au SHIFUMI, la balle va aléatoirement à "; 
            if( rand(0,1) == 0 ) {
                $res = "win1";
            }
            else {
                $res = "win2";
            }
        }
        else {
            $msg .= "Après le SHIFUMI, la balle est gagnée par ";
        }
        if( $res == "win1" )
            $msg .= $name_p1."<br/>";
        else
            $msg .= $name_p2."<br/>";

        for( $id_att = 1; $id_att < 5; $id_att++) {
        // Attaque 1
        $pos = $res;
        $diff = 0;
        /* $diff = rand(0,4)-2; */
        $msg .= "<h4>Attaque ".$id_att.": ";
        switch( $zone ) {
        case 'GAUCHE':
            // Gauche
            if( $pos == "win1" ) 
{                $msg .= $name_p1." sur sa GAUCHE</h4>";
                $diff += $this->solve_attack( $val_p1['attG'], $val_p2['defD'],
                $conf_p1->sfmG, $conf_p2->sfmD, $msg );
            }
            else {
                $msg .= $name_p2." sur sa DROITE</h4>";
                $diff +=$this->solve_attack( $val_p2['attD'], $val_p1['defG'],
                $conf_p2->sfmD, $conf_p1->sfmG, $msg );
            }
            break;
        case 'CENTRE':
            // Center
            if( $pos == "win1" ) {
                $msg .= $name_p1." au CENTRE</h4>";
                $diff +=$this->solve_attack( $val_p1['attC'], $val_p2['defC'],
                $conf_p1->sfmC, $conf_p2->sfmC, $msg);
            }
            else {
                $msg .= $name_p2." au CENTRE</h4>";
                $diff +=$this->solve_attack( $val_p2['attC'], $val_p1['defC'],
                $conf_p2->sfmC, $conf_p1->sfmC, $msg);
            }
            break;
        case 'DROITE':
            // Droite
            if( $pos == "win1" ) {
                $msg .= $name_p1." sur sa DROITE</h4>";
                $diff +=$this->solve_attack( $val_p1['attD'], $val_p2['attD'],
                $conf_p1->sfmD, $conf_p2->sfmG, $msg);
            }
            else {
                $msg .= $name_p2." sur sa GAUCHE</h4>";
                $diff +=$this->solve_attack( $val_p2['attG'], $val_p1['defD'],
                $conf_p2->sfmG, $conf_p1->sfmD, $msg);
            }
            break;
        }
        $next_conf = 'conf_p';
        $next_phase = 'phase'.($id_att+1);
        $msg .= "Au final, la valeur d'attaque vaut ".$diff.". ";
        if( $diff > 0 ) {
            if( $pos == "win1" ) {
                $msg .= " La phase a été gagnée par ".$name_p1;
                $msg .= " qui marque un POINT.<br>";
                $score_p1 += 1;
                $res = "win2";
                $next_conf .= '2';
            }
            else {
                $msg .= " La phase a été gagnée par ".$name_p2;
                $msg .= " qui marque un POINT.<br>";
                $score_p2 += 1;
                $res = "win1";
                $next_conf .= '1';
            }
        }              
        else if( $diff < 0 ) {
            if( $pos == "win1" ) {
                $msg .= " La phase a été gagnée par ".$name_p2;
                $msg .= " qui prend le contrôle de la balle pour la prochaine phase.<br/>";
                $res = "win2";
                $next_conf .= '2';
            }
            else {
                $msg .= " La phase a été gagnée par ".$name_p1;
                $msg .= " qui prend le contrôle de la balle pour la prochaine phase.<br/>";
                $res = "win1";
                $next_conf .= '1';
            }
        }
        else {
            $msg .= " Personne ne prend l'ascendant. ";
            if( $pos == "win1" ) {
                $msg .= $name_p1." garde la balle<br/>";
                $next_conf .= '1';
                $res = $pos;
            }
            else {
                $msg .= $name_p2." garde la balle<br/>";
                $next_conf .= '2';
                $res= $pos;
            }
        }
        $msg .= "SCORE : ".$name_p1." ".$score_p1." - ".$name_p2." ".$score_p2."<br/>";
        if( $id_att<4 ) {
        $zone = $$next_conf->$next_phase;
        $msg .= "La zone sera donnée par ".$next_conf."->".$next_phase.", soit ".$zone."<br/>";
        }
        }

        $game->msg_status = "Mi-temps : ".$name_p1." ".$score_p1." - ".$name_p2." ".$score_p2;
        $game->msg_result1 = $msg;
        $game->status = 'SECOND';
        $game->score1 = $score_p1;
        $game->score2 = $score_p2;
        $game->save();
        return $msg;
    }
    public function run_second_period($gid)
    {
        $game = Game::findOrFail($gid);
        $conf_p1 = $game->conf12;
        $conf_p2 = $game->conf22;
        $name_p1 = $game->player1->name;
        $name_p2 = $game->player2->name;
        $val_p1 = $this->get_total( $conf_p1 );
        $val_p2 = $this->get_total( $conf_p2 );
        $score_p1 = $game->score1;
        $score_p2 = $game->score2;

        $msg = "";
        // first phase
        $zone = $this->arr_zone[rand(0,2)];
        $pos = 0; // Possession de la balle a win1 ou win2
        switch( $zone ) {
        case 'GAUCHE':
            // Gauche
            $msg .= "Balle atterit dans la zone GAUCHE de l'équipe ".$name_p1."<br/>";
            $msg .= $conf_p1->sfmG." vs ".$conf_p2->sfmD."<br/>";
            $res = $this->shifumi( $conf_p1->sfmG, $conf_p2->sfmD );
            break;
        case 'CENTRE':
            // Center
            $msg .= "Balle atterit dans la zone CENTRE<br/>";
            $msg .= $conf_p1->sfmC." vs ".$conf_p2->sfmC."<br/>";
            $res = $this->shifumi( $conf_p1->sfmC, $conf_p2->sfmC );
            break;
        case 'DROITE':
            // Droite
            $msg .= "Balle atterit dans la zone DROITE de l'équipe ".$name_p1."<br/>";
            $msg .= $conf_p1->sfmD." vs ".$conf_p2->sfmG."<br/>";
            $res = $this->shifumi( $conf_p1->sfmD, $conf_p2->sfmG );
            break;
        }
        if( $res == 'draw' ) {
            $msg .= "Après égalité au SHIFUMI, la balle va aléatoirement à "; 
            if( rand(0,1) == 0 ) {
                $res = "win1";
            }
            else {
                $res = "win2";
            }
        }
        else {
            $msg .= "Après le SHIFUMI, la balle est gagnée par ";
        }
        if( $res == "win1" )
            $msg .= $name_p1."<br/>";
        else
            $msg .= $name_p2."<br/>";

        for( $id_att = 1; $id_att < 5; $id_att++) {
        // Attaque 1
        $pos = $res;
        $diff = 0;
        /* $diff = rand(0,4)-2; */
        $msg .= "<h4>Attaque ".$id_att.": ";
        switch( $zone ) {
        case 'GAUCHE':
            // Gauche
            if( $pos == "win1" ) 
{                $msg .= $name_p1." sur sa GAUCHE</h4>";
                $diff += $this->solve_attack( $val_p1['attG'], $val_p2['defD'],
                $conf_p1->sfmG, $conf_p2->sfmD, $msg );
            }
            else {
                $msg .= $name_p2." sur sa DROITE</h4>";
                $diff +=$this->solve_attack( $val_p2['attD'], $val_p1['defG'],
                $conf_p2->sfmD, $conf_p1->sfmG, $msg );
            }
            break;
        case 'CENTRE':
            // Center
            if( $pos == "win1" ) {
                $msg .= $name_p1." au CENTRE</h4>";
                $diff +=$this->solve_attack( $val_p1['attC'], $val_p2['defC'],
                $conf_p1->sfmC, $conf_p2->sfmC, $msg);
            }
            else {
                $msg .= $name_p2." au CENTRE</h4>";
                $diff +=$this->solve_attack( $val_p2['attC'], $val_p1['defC'],
                $conf_p2->sfmC, $conf_p1->sfmC, $msg);
            }
            break;
        case 'DROITE':
            // Droite
            if( $pos == "win1" ) {
                $msg .= $name_p1." sur sa DROITE</h4>";
                $diff +=$this->solve_attack( $val_p1['attD'], $val_p2['attD'],
                $conf_p1->sfmD, $conf_p2->sfmG, $msg);
            }
            else {
                $msg .= $name_p2." sur sa GAUCHE</h4>";
                $diff +=$this->solve_attack( $val_p2['attG'], $val_p1['defD'],
                $conf_p2->sfmG, $conf_p1->sfmD, $msg);
            }
            break;
        }
        $next_conf = 'conf_p';
        $next_phase = 'phase'.($id_att+1);
        $msg .= "Au final, la valeur d'attaque vaut ".$diff.". ";
        if( $diff > 0 ) {
            if( $pos == "win1" ) {
                $msg .= " La phase a été gagnée par ".$name_p1;
                $msg .= " qui marque un POINT.<br>";
                $score_p1 += 1;
                $res = "win2";
                $next_conf .= '2';
            }
            else {
                $msg .= " La phase a été gagnée par ".$name_p2;
                $msg .= " qui marque un POINT.<br>";
                $score_p2 += 1;
                //$msg .= " qui prend le contrôle de la balle pour la prochaine phase.<br/>";
                $res = "win1";
                $next_conf .= '1';
            }
        }              
        else if( $diff < 0 ) {
            if( $pos == "win1" ) {
                $msg .= " La phase a été gagnée par ".$name_p2;
                $msg .= " qui prend le contrôle de la balle pour la prochaine phase.<br/>";
                $res = "win2";
                $next_conf .= '2';
            }
            else {
                $msg .= " La phase a été gagnée par ".$name_p1;
                $msg .= " qui prend le contrôle de la balle pour la prochaine phase.<br/>";
                $res = "win1";
                $next_conf .= '1';
            }
        }
        else {
            $msg .= " Personne ne prend l'ascendant. ";
            if( $pos == "win1" ) {
                $msg .= $name_p1." garde la balle<br/>";
                $next_conf .= '1';
                $res= $pos;
            }
            else {
                $msg .= $name_p2." garde la balle<br/>";
                $next_conf .= '2';
                $res= $pos;
            }
        }
        $msg .= "SCORE: ".$name_p1." ".$score_p1." - ".$name_p2." ".$score_p2."<br/>";
        if( $id_att<4 ) {
        $zone = $$next_conf->$next_phase;
        $msg .= "La zone sera donnée par ".$next_conf."->".$next_phase.", soit ".$zone."<br/>";
        }
        }

        $game->msg_status = "SCORE FINAL: ".$name_p1." ".$score_p1." - ".$name_p2." ".$score_p2;
        $game->msg_result2 = $msg;
        $game->status = 'END';
        $game->score1 = $score_p1;
        $game->score2 = $score_p2;
        $game->save();
        return $msg;
    }

    
    /** Display a game for a given player */
    public function play_game($gid)
    {
        //$player = User::findOrFail($pid);
        $player = Auth::user();
        $game = Game::findOrFail($gid);
        $pos1 = ($game->player1_id == $player->id);
        Debugbar::info( "play_game with player->id=".$player->id );
        Debugbar::info( "play_game with game->player1->id=".$game->player1->id );
        Debugbar::info( "play_game with pos=".$pos1 );
        return view('game_play', ['game' => $game, 'player'=>$player, 'pos1' => $pos1]);
    }

    /** Create a new configuration for a player */
    public function add_configuration(ConfPostRequest $request, $pid, $gid)
    {
        // Validation is done inside ConfPostRequest
        

        // TO DEBUG
        $conf = Configuration::create($request->all());
        Debugbar::info( "created conf id=".$conf->id );
        
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
            $this->run_first_period( $game->id );
        }
        else if( $game->status == 'SECOND'
            and $game->second1 != 0 and $game->second2 != 0 ) {
            $this->run_second_period( $game->id );
        }

        //DEBUG return;
        return redirect()->action( 'GameController@show_game', ['pid'=>$player->id, 'gid'=>$game->id]);
        //return 'Conf id='.$conf->id.' created';
    }

    public function show_game_admin($pid,$gid)
    {
        $player = User::findOrFail($pid);
        $game = Game::findOrFail($gid);
        return view('game_show', ['game' => $game, 'player'=>$player]);
    }
    public function show_game($gid)
    {
        $player = Auth::user();
        $game = Game::findOrFail($gid);
        return view('game_show', ['game' => $game, 'player'=>$player]);
    }
    
    public function reset_game($pid,$gid)
    {
        $player = User::findOrFail($pid);
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
        return redirect()->action( 'GameController@all_game', []);
    }

    public function list_game($pid)
    {
        $player = User::findOrFail($pid);
        $games = $player->getGames();
        return view('game_list', ['player' => $player, 'games' => $games]);
    }
    public function my_game()
    {
        $player = Auth::user();
        $games = $player->getGames();
        return view('game_list', ['player' => $player, 'games' => $games]);
    }
    public function all_game()
    {
        $games = Game::all();
        return view('game_all', ['games' => $games]);
    }
    
     
}
