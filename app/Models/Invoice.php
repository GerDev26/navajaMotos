<?php

namespace App\Models;

use App\Traits\HasSeparatedTimestamp;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasSeparatedTimestamp;
    public $timestamps = true;

    public function get_work_price(){
        $worksPrices = WorkInvoice::select('unit_price')->where('invoice_id', $this->id)->get();
        $totalPrice = 0;
        foreach ($worksPrices as $wp) {
            $totalPrice += $wp->unit_price;
        }
        return $totalPrice;
    }
    public function get_replacement_price(){
        $replacementsPrices = ReplacementInvoice::select('unit_price', 'quantity')->where('invoice_id', $this->id)->get();
        $totalPrice = 0;
        foreach ($replacementsPrices as $rp) {
            $totalPrice += ($rp->unit_price * $rp->quantity);
        }
        return $totalPrice;
    }
    public function get_total_price(){
        if($this->total_price){
            return $this->total_price;
        }
        $replacementsPrice = $this->get_replacement_price();
        $worksPrice = $this->get_work_price();
        return $replacementsPrice + $worksPrice;
    }
}
