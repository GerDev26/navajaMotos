<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasSeparatedTimestamp;
    public $timestamps = true;
}
