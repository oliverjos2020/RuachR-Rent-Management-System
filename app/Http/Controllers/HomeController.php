<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\saleTimer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $recentProducts = Product::latest()->take(12)->get();
        // $featuredProducts = Product::where('featured', '1')->limit(12)->get();
        // $categories = Category::where('featured', 1)->withCount(['products' => function ($query) {
        //     $query->where('is_illustrator', 1);
        // }])->get();

        // $illustrator = Product::where('is_illustrator', '1')->inRandomOrder()->take(4)->get();
        // $existingRecord = saleTimer::first();
        // $timer = saleTimer::first();
        // if (!$existingRecord) {
        //     // If $existingRecord is not found, create a new instance of saleTimer model
        //     $timer = new saleTimer();
        //     $timer->sales_end = "0";
        //     $timer->status = "0";
        //     $timer->save(); // Save the new instance to the database
        // } else {
        //     $timer = $existingRecord;
        // }

        // if ($timer->status == 1) {
        //     $salePrice = Product::where('sale_price', '>', '0')->get();
        // } else if ($timer->status == 0) {
        //     $salePrice = Product::inRandomOrder()->take(12)->get();
        // }
        return view('index');

        return view('index', [
            'recentProducts' => $recentProducts,
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
            'salePrice' => $salePrice,
            'saleTimer' => $timer,
            'illustrator' => $illustrator,
        ]);
    }

}
