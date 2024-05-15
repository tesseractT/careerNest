<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            'High School',
            'Diploma',
            'Bachelor\'s Degree',
            'Master\'s Degree',
            'Doctorate Degree'
        ];

        foreach ($educations as $item) {
            $create = new Education();
            $create->name = $item;
            $create->save();
        }
    }
}
