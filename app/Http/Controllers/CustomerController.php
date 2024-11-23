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
}
