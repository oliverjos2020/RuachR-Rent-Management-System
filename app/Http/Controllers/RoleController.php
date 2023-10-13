<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(){
        return view('dashboard.roles', ['roles'=>Role::all()]);
    }

    public function store(){
        request()->validate([
            'name' => ['string','required']
        ]);
        Role::create([
            'name'=>Str::ucfirst(request('name')),
        ]);
        Session::flash('role-created', 'Role '.request()->name.' created');
        return back();
    }

    public function delete(Role $role){
        $role->delete();
        Session::flash('role-deleted', 'Role '.$role->name.' deleted');
        return back();
    }

    public function edit(Role $role){
        return view('dashboard.edit-role', [
            'role' => $role, 
            'roles' => Role::all()
        ]);
    }

    public function update(Role $role){
        $role->name = Str::ucfirst(request('name'));
        if($role->isDirty('name')){
            Session::flash('role-updated', 'Role Updated to ->'.request()->name);
            $role->save();
        }else{
            Session::flash('role-updated', 'Nothing has been update');
        }
        return back();
    }
}
