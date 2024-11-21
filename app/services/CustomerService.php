<?php

namespace App\Services;

use App\Filters\CustomerFilter;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CustomerService {
    public static function get_filtered_customers(Request $request)
    {
        $filters = new CustomerFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);
        return Customer::where($queryItems)->orderBy($order, $query)->get();
    }
}