<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VehicleModel;
use App\Models\Work;
use Database\Factories\CustomerFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
/*         User::customerFactory()
              ->count(10)
              ->create(); */
        $this->call(VehicleSeeder::class);
        $this->call(ReplacementSeeder::class);
        $this->call(WorkSeeder::class);
    }
}
