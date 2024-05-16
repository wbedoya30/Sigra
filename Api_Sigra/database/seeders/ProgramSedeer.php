<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('programs')->insert([
            [
                'name' => '',
                'description' => '',
                'duration' => '',
                'awarded_title' => '',
                'image'=> '',
                // 'coordinator_id' => 1,

            ],
        ]);
    }
}
