<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Vehicle;
use App\Services\InvoiceService;
use App\Services\PdfService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function get_pdf($id){
        $Invoice = Invoice::find($id);
        return PdfService::get_invoice_pdf([
            'customer' => $Invoice->user,
            'vehicle' => $Invoice->vehicle,
            'invoice_works' => $Invoice->get_works(),
            'invoice_replacements' => $Invoice->get_replacements(),
            'date' => $Invoice->date,
            'total_price' => $Invoice->total_price,
        ]);
    }
}
