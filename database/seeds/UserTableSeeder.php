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

        factory(App\User::class)->create(
          [
            'name'=>'Nombre del instructor',
            'email'=>'coach@fitcoach.mx',
            'password'=>bcrypt('admin123'),
            'clases'=>'1',
            'role' =>'instructor'
          ]
        );
        factory(App\User::class)->create(
          [
            'name'=>'Admin',
            'email'=>'admin@fitcoach.mx',
            'password'=>bcrypt('admin123'),
            'role' =>'superadmin'
          ]
        );

    }
}
