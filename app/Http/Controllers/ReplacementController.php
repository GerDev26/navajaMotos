<?php

namespace App\Http\Controllers;

use App\Services\ReplacementService;
use Illuminate\Http\Request;

class ReplacementController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = ReplacementService::get_replacements($request);
        return response()->json($vehicles, 200);
    }
    public function invoice_replacement_index(Request $request){
        $vehicles = ReplacementService::get_invoice_replacement($request);
        return response()->json($vehicles, 200);
    }
    public function store(Request $request)
    {
        try{
            $vehicles = ReplacementService::new_invoice_replacement($request);
            return $vehicles;
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
