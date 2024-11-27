<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceFormRequest;
use App\Services\FormService;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function invoice_form(StoreInvoiceFormRequest $request)
    {
        return FormService::save_invoice_form($request);
    }
}
