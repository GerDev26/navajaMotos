<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService {
    
    static function get(array $filter = null){
        if($filter) {
            return User::select()->filter->get();
        }
        return User::all();
    }
}