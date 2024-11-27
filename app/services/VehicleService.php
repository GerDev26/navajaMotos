<?php
namespace App\Services;

use App\Filters\VehicleFilter;
use App\Filters\VehicleModelFilter;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleService {

    public static function get_models(Request $request)
    {
        $filters = new VehicleModelFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if(!$queryItems) {
            return VehicleModel::select()->orderBy($order, $query)->paginate(6);
        }
        return VehicleModel::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function get_vehicles(Request $request){
        $filters = new VehicleFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if(!$queryItems) {
            return Vehicle::select()->orderBy($order, $query)->paginate(6);
        }
        return Vehicle::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function new_vehicle($request){
        
        $model = self::find_or_create_model($request->model);
        $vehicle = new Vehicle();
        $vehicle->vehicle_model_id = $model->id;
        $vehicle->green_card = $request->greenCard ?? null;
        $vehicle->domain = $request->domain ?? null;
        $vehicle->user_id = $request->user_id;

        $vehicle->save();

        if(!$vehicle) {
            throw new \Exception('The vehicle could not be saved');
        }

        return $vehicle;
    }

    public static function get_vehicle_by_domain(string $domain){
        $vehicle = Vehicle::where('domain', $domain)->first();
        
        if(!$vehicle){
            throw new \Exception('The vehicle was not found');
        }

        return $vehicle;
    }

    public static function find_or_create_model(string $model): VehicleModel{
        $existModel = self::exist_model($model);
        
        if($existModel){
            return self::get_model_by_desc($model);
        }

        return self::new_model($model);
    }

    public static function exist_vehicle(string $domain)
    {
        return Vehicle::where('domain', $domain)->exists();
    }

    public static function exist_model(string $model): bool{
        return VehicleModel::where('description', $model)->exists();
    }

    public static function new_model(string $modelDesc): VehicleModel{
        $model = new VehicleModel();
        $model->description = $modelDesc;
        $model->save();

        if(!$model){
            throw new \Exception('The model could not be saved');
        }

        return $model;
    }

    public static function get_model_by_desc(string $desc): VehicleModel{
        $model = VehicleModel::where('description', $desc)->first();
        
        if(!$model){
            throw new \Exception('The model was not found');
        }

        return $model;
    }
}
