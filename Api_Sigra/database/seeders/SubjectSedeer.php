<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('subjects')->insert([
            [
                'name' => '',
                'code' => '',
                'credits' => '',
                'description' => '',
            ],
        ]);
    }
}
