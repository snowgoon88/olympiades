<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'login' => 'ishkaar',
            'team' => 'SombreMarche',
            'faction' => 'Gorgonia (22)'
        ));
        User::create(array(
            'login' => 'thansep',
            'team' => 'Thansep',
            'faction' => 'MJ',
            'admin' => true
        ));
        User::create(array(
            'login' => 'bob',
            'team' => 'Les Régulateurs',
            'faction' => 'L\'ordre',
            'race' => 'ELF',
        ));
        User::create(array(
            'login' => 'bill',
            'team' => 'Le Marteau Pilon',
            'faction' => 'Ambredor',
            'race' => 'ORC'
        ));
        
            
    }
}
