<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = VehicleService::get_models($request);
        return response()->json($vehicles, 200);
    }
    public function store(Request $request)
    {
        $vehicle = VehicleService::new_vehicle($request);
        return response()->json($vehicle, 200);
    }
}
