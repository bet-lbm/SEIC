<?php

use App\Curso;
use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Curso::class,10)->create();
    }
}
