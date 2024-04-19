<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamSize::insert([
            [
                'name' => 'One Person',
                'slug' => 'one-person'
            ],

            [
                'name' => '2-10 People',
                'slug' => '2-10-people'
            ],

                [
                    'name' => '11-50 People',
                    'slug' => '11-50-people'
                ],

                [
                    'name' => '51-200 People',
                    'slug' => '51-200-people'
                ],

                [
                    'name' => '201-500 People',
                    'slug' => '201-500-people'
                ],

                [
                    'name' => '501-1000 People',
                    'slug' => '501-1000-people'
                ],

                [
                    'name' => '1001-5000 People',
                    'slug' => '1001-5000-people'
                ],

                [
                    'name' => '5001-10000 People',
                    'slug' => '5001-10000-people'
                ],

                [
                    'name' => '10001+ People',
                    'slug' => '10001-people'
                ],
            ]);
    }
}
