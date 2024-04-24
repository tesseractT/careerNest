<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'English',
            'Spanish',
            'French',
            'German',
            'Italian',
            'Dutch',
            'Russian',
            'Chinese',
            'Japanese',
            'Korean',
            'Arabic',
            'Hindi',
            'Bengali',
            'Urdu',
            'Punjabi',
            'Telugu',
            'Marathi',
            'Tamil',
            'Gujarati',
            'Kannada',
            'Odia',
            'Malayalam',
            'Sindhi',
            'Nepali',
            'Sinhala',
            'Burmese',
            'Khmer',
            'Lao',
            'Thai',
            'Vietnamese',
            'Indonesian',
            'Filipino',
            'Malay',
            'Javanese',
            'Sundanese',
            'Hausa',
            'Yoruba',
            'Igbo',
            'Zulu',
            'Xhosa',
            'Swahili',
            'Amharic',
            'Oromo',
            'Somali',
            'Tigrinya',
            'Kinyarwanda',
            'Kirundi',
            'Luganda',
            'Kikuyu',
            'Chichewa',
            'Tsonga',
            'Setswana',
            'Sesotho',
            'Sepedi',
        ];

        foreach ($languages as $language) {
            $lang = new Language();
            $lang->name = $language;
            $lang->save();
        }
    }
}
