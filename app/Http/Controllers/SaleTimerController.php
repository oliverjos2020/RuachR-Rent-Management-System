<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\saleTimer;
use Illuminate\Support\Facades\Session;

class SaleTimerController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'sales_end' => ['required'],
            'status' => ['required'],
        ]);
    
        $existingRecord = saleTimer::first();
    
        if ($existingRecord) {
            $existingRecord->update($data);
            Session::flash('timer-created', 'Timer updated');
        } else {
            saleTimer::create($data);
            Session::flash('timer-created', 'Timer created');
        }
    
        return back();
    }

    public function status(saleTimer $saleTimer, $sale){

        $product = saleTimer::first();
        $product->status = $sale;
        $product->save();
        Session::flash('status', 'Status Changed Successfully');
       
        return back();
}
    
}
