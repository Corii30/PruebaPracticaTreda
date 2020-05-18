<?php

use Illuminate\Database\Seeder;
use App\Tienda;

class TiendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tienda::class, 10)->create();
    }
}
