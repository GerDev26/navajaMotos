<?php

namespace App\Services;

use App\Filters\VehicleFilter;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleService {
    public static function get_models(Request $request)
    {
        $filters = new VehicleFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if(!$queryItems) {
            return VehicleModel::select()->orderBy($order, $query)->paginate(6);
        }
        return VehicleModel::where($queryItems)->orderBy($order, $query)->get();
    }
    public static function new_vehicle(Request $request){

        $vehicle = new Vehicle();
        $existModel = self::exist_model($request->model); //No devuelve bien la condicion
        $model = self::get_model_by_desc($request->model);
        return $model;
        if(!$existModel){
            $vehicle->vehicle_model_id = $model->id;
            return 'existe';
        } else {
            $model = self::new_model($request->model);
            return 'no existe';
            $vehicle->vehicle_model_id = $model->id;
        }


        $vehicle->green_card = $request->green_card ?? null;
        $vehicle->domain = $request->domain ?? null;

        $vehicle->save();

        if(!$vehicle){
            return response()->json(['error' => 'No se pudo guardar el vehiculo'], 400);
        }

        return $vehicle;
    }
    private static function exist_model(string $model){
        $affectedRows = VehicleModel::where('description', $model)->count();
        return $affectedRows > 0 ? true : false;
    }

    private static function new_model($newModel){
        $model = new VehicleModel();
        $model->description = $newModel;
        $model->save();

        if(!$model){
            return response()->json(['error' => 'No se pudo guardar el modelo'], 400);
        }

        return $model;
    }

    private static function get_model_by_desc($desc){
        $model = VehicleModel::where('description', $desc)->first();
        
        if(!$model){
            return response()->json(['error' => 'No se pudo guardar el modelo'], 400);
        }

        return $model;
    }
}