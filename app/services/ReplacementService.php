<?php

namespace App\Services;

use App\Filters\ReplacementFilter;
use App\Filters\ReplacementInvoiceFilter;
use App\Models\Replacement;
use App\Models\ReplacementInvoice;
use Illuminate\Http\Request;

class ReplacementService
{
    public static function get_replacements(Request $request)
    {
        $filters = new ReplacementFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if (!$queryItems) {
            return Replacement::select()->orderBy($order, $query)->paginate(6);
        }
        return Replacement::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function get_invoice_replacement(Request $request)
    {
        $filters = new ReplacementInvoiceFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if (!$queryItems) {
            return ReplacementInvoice::select()->orderBy($order, $query)->paginate(6);
        }
        return ReplacementInvoice::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function new_invoice_replacement($request)
    {
        $replacement = self::find_or_create_replacement($request->replacement);

        $invoiceReplacement = new ReplacementInvoice();
        $invoiceReplacement->replacement_id = $replacement->id;
        $invoiceReplacement->invoice_id = $request->invoice_id;
        $invoiceReplacement->unit_price = $request->unit_price;
        $invoiceReplacement->quantity = $request->quantity;

        $invoiceReplacement->save();

        if (!$invoiceReplacement) {
            throw new \Exception('The invoice replacement could not be saved');
        }

        return $invoiceReplacement;
    }

    public static function find_or_create_replacement(string $replacement): Replacement
    {
        $existReplacement = self::exist_replacement($replacement);

        if ($existReplacement) {
            return self::get_replacement_by_desc($replacement);
        }

        return self::new_replacement($replacement);
    }

    public static function exist_replacement(string $replacement): bool
    {
        return Replacement::where('description', $replacement)->exists();
    }

    public static function new_replacement(string $replacementDesc): Replacement
    {
        $replacement = new Replacement();
        $replacement->description = $replacementDesc;
        $replacement->save();

        if (!$replacement) {
            throw new \Exception('The replacement could not be saved');
        }

        return $replacement;
    }

    public static function get_replacement_by_desc(string $desc): Replacement
    {
        $replacement = Replacement::where('description', $desc)->first();

        if (!$replacement) {
            throw new \Exception('The replacement was not found');
        }

        return $replacement;
    }
    public static function new_replacement_collection(array | object $replacements){

        return collect($replacements)->map(function ($replacement) {
            return ReplacementService::new_invoice_replacement($replacement);
        });
    }
    
}
