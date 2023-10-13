<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use App\Models\User;
use App\Models\Category;
// use App\Models\Location;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
    public function create(Category $category){
        return view('dashboard.create-property', [
            'category'=>[],
            'location'=>[]
       ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => ['required','string','min:15'],
            'short_description' => ['required','string','min:15','max:255'],
            'description' => ['required','string','min:15'],
            'category_id' => 'required',
            'location_id' => 'required',
            'amount' => 'required',
            'featured' => 'required',
            'offer' => 'required',
            'featured_image' => ['file:jpg,jpeg,png,bmp']
        ]);

        if($file = $request->file('featured_image')){

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $data['featured_image'] = $name;
    
            }else{
                $name = "avatar.jpg";
                $data['featured_image'] = $name;
            }
        //$newProperty = Property::create($data);
        $newProperty = auth()->user()->properties()->create($data);

        if($request->has('photo_id')){
            foreach($request->file('photo_id')as $image){
                $imageName = $data['title'].'-image-'.time().rand(1,100).'.'.$image->extension();
                $image->move(public_path('images'), $imageName);
                Photo::create([
                    'property_id' => $newProperty->id,
                    'file' => $imageName
                ]);
            }
        }
        Session::flash('property-created', 'Property created');
        return back();
    }

    public function show(Property $property){
        return view('dashboard.manage-property', ['property'=>$property::all()]);
    }

    public function edit($id, Category $category, Photo $photo){

        $property = Property::findOrFail($id);
        $photo = Photo::where('property_id', $id)->get();
        return view('dashboard.edit-property', [
            'photo'=>$photo,
            'property'=>$property, 
            'category'=>$category::all()
            // 'location'=>$location::all()
        ]);
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'title' => 'required',
            'short_description' => ['required','string','min:15'],
            'description' => ['required','string','min:15'],
            'category_id' => 'required',
            'location_id' => 'required',
            'amount' => 'required',
            'featured' => 'required',
            'offer' => 'required',
            'featured_image' => ['file:jpg,jpeg,png,bmp']
        ]);
        //$newProperty = Property::create($data);

        if($file = $request->file('featured_image')){

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $data['featured_image'] = $name;
    
            }
        $newProperty = auth()->user()->properties()->whereId($id)->first()->update($data);

        if($request->has('photo_id')){
            foreach($request->file('photo_id')as $image){
                $imageName = $data['title'].'-image-'.time().rand(1,100).'.'.$image->extension();
                $image->move(public_path('images'), $imageName);
                Photo::create([
                    'property_id' => $id,
                    'file' => $imageName
                ]);
            }
        }
        Session::flash('property-updated', 'Property updated');
        return back();
    }

    public function destroy($id){

        $property = Property::findOrFail($id);
        $photo = Photo::where('property_id', $id)->get();
        foreach($photo as $photos){
            unlink(public_path() . $photos->file);
        }
        
        $property->delete();
        Session::flash('property-deleted', "Property deleted");
        return back();
    }
}
