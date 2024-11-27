<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request){
        try {
            return InvoiceService::new_invoice($request);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
