<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(
          [
            'name'=>'Alexis',
            'email'=>'alx.morales@outlook.com',
            'password'=>bcrypt('admin123'),
            'role' =>'superadmin'
          ]
        );
        factory(App\User::class,5)->create();

    }
}
