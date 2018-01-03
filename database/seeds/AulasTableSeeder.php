<?php

use App\Aula;
use Illuminate\Database\Seeder;

class AulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Aula::class,5)->create();
    }
}
