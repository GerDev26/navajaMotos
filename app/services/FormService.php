<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Exception;

class FormService
{
    //falta verificar si el vehiculo es del usuario
    public static function save_invoice_form(Request $request)
    {
        try {
            $customerService = new CustomerService();
            $customer = $customerService->find_or_create_user($request->username);

            //Verifico que el dominio este en el array de la request o en la base de datos
            self::check_vehicles($request->selectedVehicle, $request->vehicles);

            if($request->has('vehicles')){
                //checkeo si el dominio esta duplicado en el array
                self::is_domain_duplicated_on_array($request->vehicles);
                
                //creo los vehiculos si el usuario lo solicito
                self::process_vehicles($request->vehicles, $customer);
            }
            
            //recupero el vehiculo seleccionado de la base de datos y creo una nueva factura
            $selectedVehicle = VehicleService::get_vehicle_by_domain($request->selectedVehicle);
            $invoice = InvoiceService::new_invoice();

            //creo los repuestos y trabajos a partir de la request
            self::process_works($request->works, $customer, $invoice);
            self::process_replacements($request->replacements, $customer, $invoice);

            //creao la factura asignandole el vehiculo seleccionado 
            self::finalize_invoice($invoice, $customer, $selectedVehicle);

            return $invoice;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    private static function check_vehicles($vehicleDomain, $vehiclesArray)
    {
        $existsVehicle = VehicleService::exist_vehicle($vehicleDomain);
        $existsInArray = collect($vehiclesArray)->contains(fn($vehicle) => $vehicle['domain'] === $vehicleDomain);

        if (!$existsInArray && !$existsVehicle) {
            throw new Exception("The domain '$vehicleDomain' is not present in the request or the database.");
        }
    }
    

    private static function is_domain_duplicated_on_array($vehicles): void
    {
        $seen = [];
        foreach ($vehicles as $vehicle) {
            if (in_array($vehicle['domain'], $seen)) {
                throw new Exception("The vehicle domain '" . $vehicle['domain'] . "' is duplicated.");
            }
            $seen[] = $vehicle['domain'];
        }
    }

    private static function process_vehicles(array $requestVehicles, $customer)
    {
        $vehicles = Helper::array_to_object($requestVehicles);
        foreach ($vehicles as $vehicle) {
            $vehicle->user_id = $customer->id;
            VehicleService::new_vehicle($vehicle);
        }
    }

    private static function process_works(array $requestWorks, $customer, $invoice)
    {
        $works = Helper::array_to_object($requestWorks);
        foreach ($works as $work) {
            $work->user_id = $customer->id;
            $work->invoice_id = $invoice->id;
            WorkService::new_invoice_work($work);
        }
    }

    private static function process_replacements(array $requestReplacements, $customer, $invoice)
    {
        $replacements = Helper::array_to_object($requestReplacements);
        foreach ($replacements as $replacement) {
            $replacement->user_id = $customer->id;
            $replacement->invoice_id = $invoice->id;
            ReplacementService::new_invoice_replacement($replacement);
        }
    }

    private static function finalize_invoice($invoice, $customer, $selectedVehicle)
    {
        $invoice->user_id = $customer->id;
        $invoice->vehicle_id = $selectedVehicle->id;

        $invoice->total_price = $invoice->get_work_price() + $invoice->get_replacement_price();
        $invoice->save();
    }
}
