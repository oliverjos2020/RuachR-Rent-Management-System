<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    public function index(SubCategory $subcategory){
        return view('dashboard.sub-categories', [
            'subcategory'=>SubCategory::all(),
            'category'=>Category::all()
        ]);
    }

    public function store(){
        request()->validate([
            'category_id' => ['required'],
            'name' => ['required']
        ]);
        SubCategory::create([
            'category_id' => request('category_id'),
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
        Session::flash('subcategory-created', ''.request()->name." created");
        return back();
    }

    public function edit(SubCategory $subcategory){
        return view('dashboard.editsubcategory', [
        'subcategory' => $subcategory, 
        'subcategories' => SubCategory::all(),
        'category'=>Category::all()
        ]);
    }

    public function update(SubCategory $subcategory){
        $subcategory->category_id = request('category_id');
        $subcategory->name = Str::ucfirst(request('name'));
        $subcategory->slug = Str::of(request('name'))->slug('-');
        if($subcategory->isDirty('name')){
            Session::flash('subcategory-updated', ''.request()->name." updated");
            $subcategory->save();
        }else{
            Session::flash('subcategory-updated', 'Nothing has been updated');
        }
        return back();
    }

    public function delete(SubCategory $subcategory){
        $subcategory->delete();
        Session::flash('subcategory-deleted', ''.$subcategory->name." deleted");
        return back();
    }
}
