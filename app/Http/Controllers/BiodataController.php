<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('dashboard.biodata', ['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = request()->validate([
            'marital_status' => ['required','string','max:255','min:2'],
            'occupation' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'religion' => ['required', 'string', 'max:100'],
            'tribe' => ['required', 'string', 'max:100']
        ]);
        auth()->user()->biodatas()->create($input);
        Session::flash('biodata-created', 'Biodata has been created');
        return redirect()->route('dashboard.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.profile', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.edit-biodata', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Biodata $biodata)
    {
        $input = request()->validate([
            'marital_status' => ['required','string','max:255','min:2'],
            'occupation' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'religion' => ['required', 'string', 'max:100'],
            'tribe' => ['required', 'string', 'max:100']
        ]);
        // auth()->user()->biodatas()->create($input);
        $biodata->update($input);
        Session::flash('biodata-updated', 'Biodata has been updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
