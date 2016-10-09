<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'status', 'player1', 'player2',
        'first1', 'first2', 'dice1',
        'second1', 'second2', 'dice2',
        'msg_status', 'msg_result'
    ];
    /** Relationships */
    public function player1() {
        return $this->belongsTo( 'App\User', 'player1_id' );
    }
    public function player2() {
        return $this->belongsTo( 'App\User', 'player2_id' );
    }
    public function conf11() {
        return $this->belongsTo( 'App\Configuration', 'first1' );
    }
    public function conf21() {
        return $this->belongsTo( 'App\Configuration', 'first2' );
    }
    public function conf12() {
        return $this->belongsTo( 'App\Configuration', 'second1' );
    }
    public function conf22() {
        return $this->belongsTo( 'App\Configuration', 'second2' );
    }    
}
