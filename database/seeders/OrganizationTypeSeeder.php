<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizationType = [
            'Government',
            'Semi Government',
            'Public',
            'Private',
            'NGO',
            'International Agencies',
        ];

        foreach ($organizationType as $type) {
            $organizationType = new OrganizationType();
            $organizationType->name = $type;
            $organizationType->save();
        }
    }
}
