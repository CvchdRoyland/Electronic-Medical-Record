<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('relationships')->insert([
            ['name' => 'Mother'],
            ['name' => 'Father'],
            ['name' => 'Sister'],
            ['name' => 'Brother'],
            ['name' => 'Aunt'],
            ['name' => 'Uncle'],
            ['name' => 'Nephew'],
            ['name' => 'Niece'],
            ['name' => 'Cousin'],
            ['name' => 'Spouse'],
            ['name' => 'Son'],
            ['name' => 'Daughter'],
            ['name' => 'Head of the Family'],
            ['name' => 'Common Law Spouse'],
            ['name' => 'Grandfather'],
            ['name' => 'Grandmother'],
            ['name' => 'Sister-In-Law'],
            ['name' => 'Brother-In-Law'],
            ['name' => 'Father-In-Law'],
            ['name' => 'Mother-In-Law'],
            ['name' => 'Common Law Father'],
            ['name' => 'Common Law Mother'],
            ['name' => 'Significant Other'],
            ['name' => 'DAUGHTER-IN-LAW'],
            ['name' => 'Granddaughter'],
            ['name' => 'Neighbor'],
            ['name' => 'Concern Citizen']
        ]);
    }
}
