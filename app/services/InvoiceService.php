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
}