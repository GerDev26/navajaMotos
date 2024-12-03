<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class ReplacementInvoice extends Model
{
    use HasSeparatedTimestamp;
    public $table = 'replacements_invoices';

    public function replacement()
    {
        return $this->belongsTo(Replacement::class);
    }
}
