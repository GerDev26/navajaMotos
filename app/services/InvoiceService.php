<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Replacement;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class InvoiceService extends UserService {

    public static function new_invoice(object $request = null){

        $invoice = new Invoice();

        if($request){
            $invoice->user_id = $request->user_id;
            $invoice->vehicle_id = $request->vehicle_id;
            $invoice->total_price = $request->total_price;
        }
        $invoice->save();

        if(!$invoice){
            throw new \Exception ('The invoice could not be saved');
        }

        return $invoice;
    }
    public static function customStore(Request $request){
        try{
            $invoice = self::new_invoice();
            $customerService = new CustomerService();
            $customer = $customerService->find_or_create_user($request->username);

            $vehicles = collect($request->vehicles);
            $works = collect($request->works);
            $replacements = collect($request->replacements);
            
            foreach ($vehicles as $vehicle) {
                $vehicle->user_id = $customer->id;
                VehicleService::new_vehicle(collect($vehicle));
            }

            foreach ($works as $work) {
                $work->user_id = $customer->id;
                $work->invoice_id = $invoice->id;
                WorkService::new_invoice_work(collect($work));
            }

            foreach ($replacements as $replacement) {
                $replacement->user_id = $customer->id;
                $replacement->invoice_id = $invoice->id;
                ReplacementService::new_invoice_replacement($replacement);
            }
            $invoice->user_id = $customer->id;
            $invoice->vehicle_id = 1;
            $invoice->total_proce = 2000;
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}