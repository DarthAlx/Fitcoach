<?php

use Illuminate\Database\Seeder;

class DetallesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Detalles::class)->create(
          [
            'dob'=>'30/09/1992',
            'accept'=>'si',
            'tel'=>'5549293724',
            'rating' =>'4.6',
            'user_id' => '1'
          ]
        );

        factory(App\Detalles::class)->create(
          [
            'dob'=>'15/09/1992',
            'accept'=>'no',
            'tel'=>'5549293725',
            'rating' =>'3.5',
            'user_id' => '3'
          ]
        );

    }
}
