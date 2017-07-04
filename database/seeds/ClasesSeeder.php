<?php

use Illuminate\Database\Seeder;

class ClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Clases::class)->create(
        [
          'nombre'=>'Yoga',
          'tipo'=>'Deportiva',
          'descripcion'=>'Clases de yoga y relajación',
          'imagen' =>'Yoga-1499123339.jpg',
          'precio' =>'500'
        ]
      );
    }
}
