<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/vehicle_models.json');

        $vehicleModels = json_decode(file_get_contents($jsonPath), true);

        foreach ($vehicleModels as $model) {
            VehicleModel::create($model);
        }
    }
}
