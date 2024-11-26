<?php

namespace App\Services;

use App\Filters\CustomerFilter;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CustomerService extends UserService {

    protected int $role = 2;

    public static function get_filtered(Request $request)
    {
        $filters = new CustomerFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);
        return User::where($queryItems)->orderBy($order, $query)->take(5)->get();
    }
    public function get_role(){
        return $this->role;
    }
}