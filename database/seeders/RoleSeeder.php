<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/roles.json');

        $roles = json_decode(file_get_contents($jsonPath), true);

        foreach ($roles as $model) {
            Role::create($model);
        }
    }
}
