<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            ProvinceSeeder::class,
            CitiesSeeder::class,
            BarangaySeeder::class,
        ]);
    }
}
