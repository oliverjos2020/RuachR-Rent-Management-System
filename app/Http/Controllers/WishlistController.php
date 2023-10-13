<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function create($wishlist){
        if (auth()->check()) { // Check if the user is logged in
            $data['user_id'] = auth()->user()->id;
            $data['product_id'] = $wishlist;
            Wishlist::create($data);
            Session::flash('add-wishlist', 'item added to your wishlist');
            return back();
        } else {
            // Handle the case when user is not logged in, e.g. redirect to login page
            return redirect()->route('login')->with('error', 'You need to login to add to your wishlist.');
        }
    }

    public function read(){
        if (auth()->check()) {
        $user = auth()->user()->id;
        $wishlist = Wishlist::where('user_id', $user)->get();
        return view('wishlist', ['wishlist'=>$wishlist]);
    } else {
        // Handle the case when user is not logged in, e.g. redirect to login page
        return redirect()->route('login')->with('error', 'You need to login to view your wishlist.');
    }
    }

    public function remove(Wishlist $wishlist){
        $wishlist->delete();
        // Session::flash('location-deleted', ''.$location->name." deleted");
        Session::flash('wishlist-deleted', ''.$wishlist->product->title.'');
        return back();
    }

    public function migrate(Request $request){
        // dd($request->wish_id);
        $wish = Wishlist::findOrFail($request->wish_id);
        $wish->delete();
    
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
        return view('cart', ['cartItem'=>$cartItem,'subtotal'=>$totalCost]);
        
        // Session::flash('cart-added', ''.request()->product_name.' created');

    }
    
}
