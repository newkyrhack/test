<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\User','usuario',5)->create();
        factory('App\Models\User','administrador',5)->create();
        factory('App\Models\User','vendedor',5)->create();
    }
}
