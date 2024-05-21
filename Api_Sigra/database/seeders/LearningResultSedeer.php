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
                'definition' => '11',
                'subject_id' => 1,
                'level_id' => 1,
            ],
            [
                'definition' => '22',
                'subject_id' => 1,
                'level_id' => 2,
            ],
            [
                'definition' => '22',
                'subject_id' => 2,
                'level_id' => 2,
            ],
        ]);
    }
}
