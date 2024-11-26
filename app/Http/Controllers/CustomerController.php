<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function get_customers(Request $request)
    {
        $customers = CustomerService::get_filtered($request);
        return response()->json($customers, 200);
    }
    public function store(Request $request){
        $customersService = new CustomerService();
        try {
            return $customersService->new_unregistered_user($request->username);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
