<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/works.json');

        $works = json_decode(file_get_contents($jsonPath), true);

        foreach ($works as $work) {
            Work::create($work);
        }
    }
}
