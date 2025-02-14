<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('provinces')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_provinces.sql'));
        }
    }
}
