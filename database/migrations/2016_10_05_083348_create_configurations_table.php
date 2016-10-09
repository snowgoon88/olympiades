<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('nbdefG');
            $table->integer('nbattG');
            $table->integer('nbquartG');
            $table->integer('nbpassG');

            $table->integer('nbdefC');
            $table->integer('nbattC');
            $table->integer('nbquartC');
            $table->integer('nbpassC');

            $table->integer('nbdefD');
            $table->integer('nbattD');
            $table->integer('nbquartD');
            $table->integer('nbpassD');            

            $table->string('phase2')->default('CENTRE');
            $table->string('phase3')->default('CENTRE');
            $table->string('phase4')->default('CENTRE');

            $table->string('sfmG')->default('PIERRE');            
            $table->string('sfmC')->default('PAPIER');
            $table->string('sfmD')->default('CISEAUX');

		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('configurations');
	}
}
