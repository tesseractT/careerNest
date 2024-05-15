<?php

namespace Database\Seeders;

use App\Models\JobExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            'Beginner',
            '1-2 Years',
            '3-5 Years',
            '6-10 Years',
            '10+ Years'
        ];

        foreach ($experiences as $item) {
            $create = new JobExperience();
            $create->name = $item;
            $create->save();
        }
    }
}
