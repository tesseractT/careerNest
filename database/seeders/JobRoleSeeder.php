<?php

namespace Database\Seeders;

use App\Models\JobRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $job_roles = array(
            "Project Manager",
            "Marketing Manager",
            "Customer Service Representative",
            "Data Scientist",
            "Cybersecurity Analyst",
            "Human Resources Manager",
            "Architect",
            "Chef",
            "Veterinarian",
            "Writer",
            "Photographer",
            "Videographer",
            "Editor",
            "Musician",
            "Actor",
            "Artist",
            "Filmmaker",
            "Lawyer",
            "Engineer",
            "Police Officer"
        );

        foreach ($job_roles as $role) {
            $create = new JobRole();
            $create->name = $role;
            $create->save();
        }
    }
}
