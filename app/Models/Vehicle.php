<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasSeparatedTimestamp;
    public $timestamps = true;
    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
