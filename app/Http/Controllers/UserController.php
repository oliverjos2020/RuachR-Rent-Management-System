<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $role = 1;
        $user = User::create($data);
        $user->roles()->attach($role);
         return json_encode(['responseCode' => 200, 'responseMessage' => $user]);
    }
    public function show()
    {
        // $user = User::whereHas('roles', function ($query) {
        //     $query->where('id', 3);
        // })->get();
        $user = User::all();
        return view('dashboard.users', ['user' => $user]);
    }
 
    public function illustrators()
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->get();
        return view('dashboard.illustrators', ['user' => $user]);
    }

    public function destroy(User $user)
    {

        $user->delete();
        // User::where('id', $user)->delete();
        // Session::flash('user-deleted', 'User deleted');
        Session::flash('user-deleted', 'User ' . $user->name . ' deleted successfuly');
        return back();
    }

    public function attach(User $user)
    {
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user)
    {
        $user->roles()->detach(request('role'));
        return back();
    }

    public function storeIllustrator(Request $request, User $user)
    {

        $data = $request->validate([
            'firstname' => ['string', 'required'],
            'lastname' => ['string', 'required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['string', 'required'],
            'shop_name' => ['string', 'required'],
            'address' => ['string', 'required'],
            'cac' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
            'agreement' => ['required'],
            'cac' => ['required','mimetypes:application/pdf'],
        ]);

        $datas['name'] = request('firstname') . " " . request('lastname');
        $datas['email'] = $data['email'];
        $datas['phone'] = $data['phone'];
        $datas['shop_name'] = $data['shop_name'];
        $datas['address'] = $data['address'];
        $datas['verify'] = 0;
        $datas['status'] = 1;
        $datas['shop_slug'] = Str::of(Str::lower(request('shop_name')))->slug('-');

        $datas['password'] = $data['password'];
        if ($file = request('cac')) {

            $name = uniqid() . '.' . $file->getClientOriginalName();
            $file->move('cac', $name);
            $datas['cac'] = $name;

        }

        $role = 2;
        $exc = User::create($datas);
        $exc->roles()->attach($role);
        Session::flash('illustrator-created', 'Registration Successful! kindly login to access your account');
        return view('auth.login');

    }

    public function status($userId, $status)
    {

        $user = User::findOrFail($userId);

        $user->status = $status;
        $user->save();

        Session::flash('status', 'Status Changed Successfully');

        return back();
    }


    public function verify($userId, $status)
    {

        $user = User::findOrFail($userId);

        $user->verify = $status;
        $user->save();

        Session::flash('verify', 'Verification Status Changed Successfully');

        return back();
    }

    public function assignstore(Request $request){
        dd($request);
    }
}
