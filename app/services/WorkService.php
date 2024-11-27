<?php

namespace App\Services;

use App\Filters\WorkFilter;
use App\Filters\WorkInvoiceFilter;
use App\Models\Work;
use App\Models\WorkInvoice;
use Illuminate\Http\Request;

class WorkService {
    public static function get_works(Request $request)
    {
        $filters = new WorkFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if(!$queryItems) {
            return Work::select()->orderBy($order, $query)->paginate(6);
        }
        return Work::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function get_invoice_work(Request $request){
        $filters = new WorkInvoiceFilter();
        $queryItems = $filters->transform($request);
        [$order, $query] = $filters->order($request);

        if(!$queryItems) {
            return WorkInvoice::select()->orderBy($order, $query)->paginate(6);
        }
        return WorkInvoice::where($queryItems)->orderBy($order, $query)->get();
    }

    public static function new_invoice_work($request){
        $work = self::find_or_create_work($request->work);

        $invoiceWork = new WorkInvoice();
        $invoiceWork->work_id = $work->id;
        $invoiceWork->invoice_id = $request->invoice_id;
        $invoiceWork->unit_price = $request->unitPrice;

        $invoiceWork->save();

        if(!$invoiceWork) {
            throw new \Exception('The invoice work could not be saved');
        }

        return $invoiceWork;
    }

    public static function find_or_create_work(string $work): Work{
        $existWork = self::exist_work($work);
        
        if($existWork){
            return self::get_work_by_desc($work);
        }

        return self::new_work($work);
    }

    public static function exist_work(string $work): bool{
        return Work::where('description', $work)->exists();
    }

    public static function new_work(string $workDesc): Work{
        $work = new Work();
        $work->description = $workDesc;
        $work->save();

        if(!$work){
            throw new \Exception('The work could not be saved');
        }

        return $work;
    }

    public static function get_work_by_desc(string $desc): Work{
        $work = Work::where('description', $desc)->first();
        
        if(!$work){
            throw new \Exception('The work was not found');
        }

        return $work;
    }
}