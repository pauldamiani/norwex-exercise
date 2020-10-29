<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //$this->call(UsertableSeeder::class);
        Model::unguard();

        $this->call(CustomerTableSeeder::class);
        $this->call(OrderSeeder::class);

        Model::reguard();
    }
}
