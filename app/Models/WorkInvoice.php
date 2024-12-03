<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class WorkInvoice extends Model
{
    use HasSeparatedTimestamp;
    public $table = 'works_invoices';
    public $timestamps = true;

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
