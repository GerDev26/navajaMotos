<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService {
    public static function get_invoice_pdf(array $invoice) {

        $title = "Factura_" . $invoice['customer']->username . "_" . $invoice['date'];

        $html = view('PDF.invoicePDF', [
            'customer' => $invoice['customer'],
            'vehicle' => $invoice['vehicle'],
            'invoice_works' => $invoice['invoice_works'],
            'invoice_replacements' => $invoice['invoice_replacements'],
            'date' => $invoice['date'],
            'total_price' => $invoice['total_price'],
            'invoice_title' => $title,
            'advancement' => $invoice['advancement']
        ])->render();

        $pdf = Pdf::loadHTML($html);

        $pdf->set_option('title', $title);

        return $pdf->stream("$title.pdf");
    }
}
