<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    
    public function index(){
        $location = Location::all();
        return view('dashboard.location', ['location'=>$location]);
    }

    public function store(){
        request()->validate([
            'name' => ['required']
        ]);
        Location::create([
            'name'=>Str::ucfirst(request('name')),
        ]);
        Session::flash('location-created', ''.request()->name." created");
        return back();
    }

    public function edit(Location $location){
        return view('dashboard.editlocation', ['location'=>$location, 'locations'=>Location::all()]);
    }

    public function update(Location $location){
        $location->name = Str::ucfirst(request('name'));
        if($location->isDirty('name')){
            Session::flash('location-updated', 'Location Updated to ->'.request()->name);
            $location->save();
        }else{
            Session::flash('location-updated', 'Nothing has been update');
        }
        return back();
    }

    public function delete(Location $location){
        $location->delete();
        Session::flash('location-deleted', ''.$location->name." deleted");
        return back();
    }
}
