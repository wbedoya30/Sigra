<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenceSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('competencies')->insert([
            [
                'type' => '',
                'description' => '',
                // 'capabilities' => '',
                'graduate_profile_id' => 1,
            ],
        ]);
    }
}
