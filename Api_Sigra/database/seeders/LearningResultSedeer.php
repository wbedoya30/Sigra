<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningResultSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('learning_results')->insert([
            [
                'definition' => '',
                'subject_id' => 1,
                'level_id' => 1,
            ],
        ]);
    }
}
