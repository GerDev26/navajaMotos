<?php

namespace App\Http\Controllers;

use App\Services\WorkService;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = WorkService::get_works($request);
        return response()->json($vehicles, 200);
    }
    public function invoice_work_index(Request $request){
        $vehicles = WorkService::get_invoice_work($request);
        return response()->json($vehicles, 200);
    }
    public function store(Request $request)
    {
        try{
            $vehicles = WorkService::new_invoice_work($request);
            return $vehicles;
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
