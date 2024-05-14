<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Sigra Admin',
                'email' => 'jo46646@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'super-admin',
            ],
            [
                'name' => 'Admin 1',
                'email' => 'a1@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin 2',
                'email' => 'a2@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Coordinador prueba 1',
                'email' => 'c1@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'coordinador',
            ],
            [
                'name' => 'Coordinador prueba 2',
                'email' => 'c2@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'coordinador',
            ],
            [
                'name' => 'Docente prueba 1',
                'email' => 'd1@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'docente',
            ],
            [
                'name' => 'Docente prueba 2',
                'email' => 'd2@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'docente',
            ],


        ]);

    }
}
