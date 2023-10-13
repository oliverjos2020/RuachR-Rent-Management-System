<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;


class cartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
 
        //     $cartCount = 0;
        //     $cartItem = [];
        //     $totalCost = 0;
            
               
        //         $roleName = "";
        //         $data = [];
        //     // Check if the user is logged in
        //     if (Auth::check()) {
        //         $userId = Auth::id(); // Get the logged-in user's ID
        //         $cartCount = Cart::where('user_id', $userId)->count(); // Get the cart count for the user from your Cart model
        //         $cartItem = Cart::where('user_id', $userId)->get();
        //         $totalCost=0;
        //         foreach ($cartItem as $cartItems) {
        //             $totalCost += $cartItems->qty * $cartItems->price;
        //         }
        //         $user = Auth::user();
        //         $roleName = $user->roles->first()->name;
 
        //         $monthCounts = Order::selectRaw('MONTH(created_at) as month, SUM(amount) as sum')
        //             ->whereYear('created_at', now()->year)
        //             ->where('owner', auth()->user()->id)
        //             ->where('status', 1)
        //             ->groupBy('month')
        //             ->pluck('sum', 'month')
        //             ->toArray();

        //         // Create an array representing months and their corresponding counts
        //         for ($month = 1; $month <= 12; $month++) {
        //             $data[] = $monthCounts[$month] ?? 0;

        //         }

        //     } else {
        //         $cartCount = 0;
        //         $cartItem = [];
        //         $totalCost = 0;
        //         $roleName = "";
        //         $data = [];
        //         // return redirect()->route('login')->with('error', 'You need to login to continue.');
        //     }

            

    
        //     $view->with(['cartCount' => $cartCount, 'cartItem' => $cartItem, 'totalCost' => $totalCost, 'roleName' => $roleName, 'cat' => Category::all(), 'data' => $data]); // Share the cart count to all views
        // 
    });
    }
}

