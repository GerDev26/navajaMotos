<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\VehicleModel;
use App\Models\Work;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Customer::factory(10)->create();
        $this->call(VehicleSeeder::class);
        $this->call(ReplacementSeeder::class);
        $this->call(WorkSeeder::class);
    }
}
