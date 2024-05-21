<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('levels')->insert([
            [
                'verb' => 'aa',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'bb',
                'taxonomy_level' => 2,
            ],
            [
                'verb' => 'cc',
                'taxonomy_level' => 3,
            ],
        ]);
    }
}
