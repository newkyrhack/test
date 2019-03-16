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
        factory('App\Models\User','usuario',3)->create();
        factory('App\Models\User','administrador',3)->create();
        factory('App\Models\User','vendedor',3)->create();
    }
}
