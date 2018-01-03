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
        $this->call(CursosTableSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(AulasTableSeeder::class);
    }
}
