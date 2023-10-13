<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use App\Models\Biodata;
use App\Models\Account;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
class DashboardController extends Controller
{
    public function index(){
        // $user = auth()->user()->id;
        // $order = Order::where('owner', $user)->where('status', 0)->get();
        // $fulfilledOrders = Order::where('owner', $user)->where('status', 1)->get();
        // $myProducts = Product::where('user_id', $user)->get();
        // $llustrators = User::where('verify', 0)->whereHas('roles', function ($query) {
        //     $query->where('id', 2);
        // })->get();




       
        // if(Account::where('user_id', $user)->exists()){
        //     Session::flash('message', 'Congratulations! You have successfully set up your account you can now recieve payment from customers.');
        // }else{
        //     Session::flash('message', 'You are yet to setup your account you wont be able to receive payment from customers kindly go to account on the menu to setup your account.');
        // }

        // return view('dashboard.index', ['order' => $order, 'fulfilledOrders' => $fulfilledOrders, 'myProducts' => $myProducts, 'llustrators' => $llustrators]);

        return view('dashboard.index');
    }

    public function accountBank(){

        $account = Account::where('user_id', auth()->user()->id)->get();
        return view('dashboard.bank-account', ['account' => $account]);


    }

    public function show(User $user){
        return view('dashboard.profile', ['user'=>$user, 'roles'=>Role::all()]);
    }

    public function account(User $user){
        return view('dashboard.account', ['user'=>$user, 'roles'=>Role::all()]);
    }
 
    public function update(User $user){
 
        $input = request()->validate([
            'name' => ['required','string','max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'max:255'],
            'avatar' => ['file:jpg,jpeg,png,bmp'],
            // 'password' => ['min:8','max:255']
        ]);

        if($avatar = request()->file('avatar')){

            $name = uniqid() . '.' .$avatar->getClientOriginalName();
            $avatar->move('images', $name);
            $input['avatar'] = $name;
    
            }

        
        Session::flash('profile-updated', 'Profile has been updated');

        $user->update($input);
        return back();
    }

    public function change(User $user){
 
        $input = request()->validate([
            'name' => ['required','string','max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'max:255'],
            'shop_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'avatar' => ['file:jpg,jpeg,png,bmp'],
            'logo' => ['file:jpg,jpeg,png,bmp'],
            'banner' => ['file:jpg,jpeg,png,bmp']
            // 'password' => ['min:8','max:255']
        ]);

        if($avatar = request()->file('avatar')){

            $name = "Profile-".$input['name'].uniqid();;
            $input['avatar'] = $name;
            $this->imageManipulator($avatar, 512, 512, $name);
        }

            if(!empty(request('password'))){
                $input = request()->validate([
                    'password' => ['required','confirmed','min:8']
                ]);
            }

            if($logo = request()->file('logo')){

                $logoName = "Logo-".$input['shop_name'].uniqid();
                $input['logo'] = $logoName;
                $this->imageManipulator($logo, 111, 45, $logoName);
            }

            if($banner = request()->file('banner')){

                $bannerName = "Banner-".$input['shop_name'].uniqid();
                $input['banner'] = $bannerName;
                $this->imageManipulator($banner, 1920, 1080, $bannerName);
            }
            // dd($input);
     
        $user->update($input);
        Session::flash('profile-updated', 'Profile has been updated');
        return back();
    }

    public function imageManipulator($data, $height, $width, $name){

        $file = Image::make($data);
        $fileSize = $file->filesize();
            $maxSize = 100 * 1024;
            if ($fileSize > $maxSize) {
                $reductionFactor = sqrt($maxSize / $fileSize);
                $file->resize(round($file->width() * $reductionFactor), round($file->height() * $reductionFactor));
                $file->fit($height, $width);
                $file->save(public_path('images/' . $name), 90);
            }else{
                $file->fit(300, 300);
                $file->save(public_path('images/' . $name));
            }
    
    }
}
