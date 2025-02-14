<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IpGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ip_groups')->insert([
            ['name' => 'Aetas'],
            ['name' => 'Ati'],
            ['name' => 'Badjaos'],
            ['name' => 'Batak'],
            ['name' => 'Blaan'],
            ['name' => 'Bontoc'],
            ['name' => 'Bukidnon'],
            ['name' => 'Higaonon'],
            ['name' => 'baloi'],
            ['name' => 'Igorot'],
            ['name' => 'Ilongots'],
            ['name' => 'Isnag'],
            ['name' => 'Isneg'],
            ['name' => 'Kalinga'],
            ['name' => 'Kankanaey'],
            ['name' => 'Lumad'],
            ['name' => 'Mamanwa'],
            ['name' => 'Mandaya'],
            ['name' => 'Mangyan'],
            ['name' => 'Manobo'],
            ['name' => 'Mansaka'],
            ['name' => 'Palawano'],
            ['name' => 'PalaweÃ±o'],
            ['name' => 'Sangir'],
            ['name' => 'Subanen'],
            ['name' => 'Tâ€™boli'],
            ['name' => 'Tagabawa'],
            ['name' => 'Tagakaulo'],
            ['name' => 'Tagbanwa']
        ]);
    }
}
