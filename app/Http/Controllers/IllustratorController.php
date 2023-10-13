<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Illustrator;
use App\Models\Product;
use App\Models\User;

class IllustratorController extends Controller
{
    
    public function store(Request $request){
        dd($request);

        $data = $request->validate([
            'firstname' => ['string','required'],
            'lastname' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['int','required','max:15'],
            'shop_name' => ['required'],
            'address' => ['required'],
            'password' => ['required','confirmed','min:8'],
            'confirm_password' => ['required'],
            'cac' => ['file', 'mimetypes:image/jpeg,image/png,image/bmp,image/pdf'],
            'agreement' => ['required']
        ]);

    }

    public function show(Product $product){

        $illustrator = Product::where('is_illustrator', '1')->get();
        
        return view('illustrator', ['illustrator'=>$illustrator]);
    }

    public function single(Product $product, $id){

        $user = User::where('id', $id)->first();

        $illustrator = Product::where('is_illustrator', '1')->where('user_id', $id)->get();
        
        return view('single-illustrator', ['illustrator'=>$illustrator, 'user'=>$user]);
    }
}
