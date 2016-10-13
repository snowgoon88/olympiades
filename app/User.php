<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Barryvdh\Debugbar\Facade as Debugbar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'faction', 'team', 'race', 'password', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** Relationships */
    public function getGames() {
        $g = $this->games1->merge( $this->games2 )->sort();
        return $g;
    }
    public function games1() {
         /* Debugbar::info("getGames1() with $this=".$this); */
         /* $games1 = $this->HasMany( 'App\Game', 'player1', 'id'); */
         /* Debugbar::info("nb=".($games1->count())); */
         /* Debugbar::info("g=".$games1->first()); */
         /* foreach( $games1->get() as $g ) { */
         /*     Debugbar::info("$g=".$g); */
         /* } */
        return $this->HasMany( 'App\Game', 'player1_id', 'id');
    }
    public function games2() {
        return $this->HasMany( 'App\Game', 'player2_id', 'id');
    }
}
