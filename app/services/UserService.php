<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserService {

    protected int $role;

    public function find_or_create_user(object $newUser){
        $existUser = self::exist_user($newUser->username);
        if ($existUser) {
            return self::get_user_by_name($newUser->username);
        }
        return self::new_unregistered_user($newUser);
    }

    public function exist_user(string $userName): bool {
        return User::where([
            ['username', $userName],
            ['role_id', $this->role],
        ])->exists();
    }

    public function new_unregistered_user(object $newUser): User {
        $faker = Faker::create();
        $user = new User();
        $user->username = $newUser->username;
        $user->email = $faker->unique()->safeEmail();
        $user->password = $faker->password();
        $user->name = $newUser->name ?? null;
        $user->phone_number = $newUser->phone_number ?? null;
        $user->role_id = $this->role;
        $user->save();

        if (!$user) {
            throw new \Exception('The user could not be saved');
        }

        return $user;
    }

    public function get_user_by_name(string $userName): User {
        $model = User::where([
            ['username', $userName],
            ['role_id', $this->role],
        ])->first();

        if (!$model) {
            throw new \Exception('The user was not found'); 
        }

        return $model;
    }

    public static function get_user_vehicles(string $userId): Collection{
        return Vehicle::select('id')->where('user_id', $userId)->get();
    }

    public function check_user_vehicle(){

    }
}
