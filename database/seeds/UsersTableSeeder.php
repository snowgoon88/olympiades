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
            'name' => 'SombreMarche',
            'faction' => 'Gorgonia (22)',
            'password' => 'bob'
        ));
        User::create(array(
            'name' => 'Thansep',
            'faction' => 'MJ',
            'admin' => true,
            'password' => 'bob'
        ));
        User::create(array(
            'name' => 'Les Régulateurs',
            'faction' => 'L\'ordre',
            'race' => 'ELF',
            'password' => 'bob'
        ));
        User::create(array(
            'name' => 'Le Marteau Pilon',
            'faction' => 'Ambredor',
            'race' => 'ORC',
            'password' => 'bob'
        ));
        
            
    }
}
