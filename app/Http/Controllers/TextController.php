<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Service;
use App\Services\UserService;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function getUsers () {
        return response()->json(User::select('email')->emailDesc()->get(), 200);
    }
}
