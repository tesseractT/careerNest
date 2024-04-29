<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::insert([
            ['name' => 'Beginner'],
            ['name' => '1-2 Years'],
            ['name' => '3-5 Years'],
            ['name' => '6-10 Years'],
            ['name' => '10+ Years']
        ]);
    }
}
