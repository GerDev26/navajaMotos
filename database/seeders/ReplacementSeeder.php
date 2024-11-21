<?php

namespace Database\Seeders;

use App\Models\Replacement;
use Illuminate\Database\Seeder;

class ReplacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/replacements.json');

        $replacements = json_decode(file_get_contents($jsonPath), true);

        foreach ($replacements as $replacement) {
            Replacement::create($replacement);
        }
    }
}
