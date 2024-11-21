<?php

namespace App\Services;


class Service {

    static function getRandomRow(string $model, Int $quantity = null){
        if($quantity){
            return $model::inRandomOrder()->limit($quantity)->get();
        }
        return $model::inRandomOrder()->first();
    }
}