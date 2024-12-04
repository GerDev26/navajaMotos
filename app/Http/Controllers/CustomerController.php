<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CustomerService;
use App\Services\VcfService;
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
            return $customersService->new_unregistered_user($request);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function charge_customers_from_vcf(Request $request){
        $contacts = VcfService::get_contacts_from_file($request->vcf_file);
        $data = [];
        foreach ($contacts as $contact) {
            $data[] = [
                'username' => $contact->name,
                'name' => $contact->name,
                'phone_number' => $contact->phone_number,
                'email' => null,
                'password' => null,
            ];
        }
        User::insert($data);
        return response()->json('Exito', 201);
    }
}
