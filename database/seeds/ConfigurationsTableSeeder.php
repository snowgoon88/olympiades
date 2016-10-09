<?php

use Illuminate\Database\Seeder;
use App\Zone;
use App\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->delete();

    }
}
