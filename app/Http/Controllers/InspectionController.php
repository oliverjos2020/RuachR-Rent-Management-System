<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function inspection(){
        $data = request()->validate([
            'property_id' => ['required','max:15'],
            'payment' => ['required','max:15'],
            'amount' => ['required','max:15'],
        ]);
        auth()->user()->carts()->create($data);
        $user = Auth()->User()->id;

        // Session::flash('cart-created', 'Item added to cart');
        return view('home.cart', ['cart'=>$cart,'cartitem'=>$cartitem,'total'=>$total]);
        return back();
    }
}
