<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            // INIT, FIRST, SECOND, END
            $table->string('status')->default('INIT');
            // Joueur
            $table->integer('player1_id')->unsigned();
            $table->integer('player2_id')->unsigned();
            // Race
            // Conf 1st half
            $table->integer('first1')->unsigned()->default(0);
            $table->integer('first2')->unsigned()->default(0);
            // Conf 2nd half
            $table->integer('second1')->unsigned()->default(0);
            $table->integer('second2')->unsigned()->default(0);
            // Resul
            $table->integer('score1')->default(0);
            $table->integer('score2')->default(0);
                        
            $table->string('msg_status')->default("-");
            $table->longText('msg_result1');
            $table->longText('msg_result2');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}
