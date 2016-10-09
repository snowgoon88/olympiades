<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /* $this->call(ZonesTableSeeder::class); */
        /* $this->command->info( 'Plein de Zone pour jouer' ); */

        //$this->call(ConfigurationsTableSeeder::class);
        //$this->command->info( 'Une configuration pour la route' );


        $this->call(UsersTableSeeder::class);
        $this->command->info( 'Des joueurs fous' );

        $this->call(GamesTableSeeder::class);
        $this->command->info( 'Hop, le coeur du jeu' );

    }
}
