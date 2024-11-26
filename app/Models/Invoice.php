<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasSeparatedTimestamp;
    public $timestamps = true;
}
