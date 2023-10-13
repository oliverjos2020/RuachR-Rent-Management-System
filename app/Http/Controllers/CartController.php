<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function create(Request $request){
    
        $user = Auth()->user()->id;
        
        $data = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'qty' => 'required',
            'price' => 'required'
        ]);

        auth()->user()->carts()->create($data);



        $cartItem = Cart::where('user_id', $user)->get();
        $totalCost=0;
        foreach ($cartItem as $cartItems) {
            $totalCost += $cartItems->qty * $cartItems->price;
        }
        Session::flash('cart-added', ''.request()->product_name.'');
        return back();
        // return view('cart', ['cartItem'=>$cartItem,'subtotal'=>$totalCost]);
        
        // Session::flash('cart-added', ''.request()->product_name.' created');

    }

    public function fetch() {
        if(auth()->check()) { // Check if user is authenticated
            $user = auth()->user()->id;
            $cartItem = Cart::where('user_id', $user)->get();
            $totalCost = 0;
            foreach ($cartItem as $cartItems) {
                $totalCost += $cartItems->qty * $cartItems->price;
            }
            return view('cart', ['cartItem'=>$cartItem, 'subtotal'=>$totalCost]);
        } else {
            // Handle case when user is not logged in
            // For example, redirect to login page or show an error message
            return redirect()->route('login')->with('error', 'Please log in to view your cart.'); // Example: redirect to login page
            // or return view('error')->with('message', 'Please log in to view your cart.'); // Example: show error message
        }
    }

    public function checkout() {
        if(auth()->check()) { // Check if user is authenticated
            $user = auth()->user()->id;
            $cartItem = Cart::where('user_id', $user)->get();
            $totalCost = 0;
            foreach ($cartItem as $cartItems) {
                $totalCost += $cartItems->qty * $cartItems->price;
            }
            return view('checkout', ['cartItem'=>$cartItem, 'subtotal'=>$totalCost]);
        } else {
            // Handle case when user is not logged in
            // For example, redirect to login page or show an error message
            return redirect()->route('login')->with('error', 'Please log in to view your cart.'); // Example: redirect to login page
            // or return view('error')->with('message', 'Please log in to view your cart.'); // Example: show error message
        }
    }
    

    public function update(Request $request) {
        $cartItem = Cart::find($request->id);
        $cartItem->qty = $request->qty;
        $cartItem->save();
    
        // Calculate the total amount in the cart
        $user = Auth()->user()->id;
        $cartItems = Cart::where('user_id', $user)->get();
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->qty * $item->price;
        }
        $totalAmount = number_format($totalAmount, 2);
    
        return response()->json([
            'totalAmount' => $totalAmount
        ]);
    }
    public function destroy(Cart $cart){
        $cart->delete();
        // Session::flash('location-deleted', ''.$location->name." deleted");
        Session::flash('cart-deleted', ''.$cart->product_name.'');
        return back();
    }

    
    
}
