<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('dashboard.categories', ['category' => $category]);
    }

    public function store(Request $request)
    {
        // $file = $request->file('category_image');
        // dd($file);

        try {

            $data = $request->validate([
                'name' => ['string', 'required'],
                'featured' => ['required'],
                'category_image' => ['file', 'mimetypes:image/jpeg,image/png,image/bmp,image/PNG,image/webp'],
            ]);

            $data['name'] = Str::ucfirst(request('name'));
            $data['slug'] = Str::of(Str::lower(request('name')))->slug('-');

            if ($file = $request->file('category_image')) {


                $catName = "Category-".$data['name'].uniqid();
                $data['category_image'] = $catName;
                $this->imageManipulator($file, 300, 300, $catName);

            } else {
                $name = "category.jpg";
                $data['category_image'] = $name;
            }

            Category::create($data);
            Session::flash('category-created', '' . request()->name . ' created');
            return back();

        } catch (\Illuminate\Database\QueryException $exception) {
            // Catch the exception for integrity constraint violation
            // Check the error code for duplicate entry error
            if ($exception->getCode() == 23000) {
                // Customize the error message to be displayed to the user
                return back()->withErrors(['name' => 'The category name is already taken. Please choose a different name.']);
            }

            // If it's not a duplicate entry error, re-throw the exception
            throw $exception;
        }
    }

    public function edit(Category $category)
    {
        return view('dashboard.editcategory', [
            'category' => $category,
            'categories' => Category::all(),
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required'],
            'featured' => ['required'],
            'category_image' => ['file', 'mimetypes:image/jpeg,image/png,image/bmp,image/webp'],
        ]);

        // $category->name = Str::ucfirst(request('name'));
        // $category->slug = Str::of(request('name'))->slug('-');
        // $category->featured = request('featured');

        $data['slug'] = Str::of(request('name'))->slug('-');


        if ($file = request()->file('category_image')) {

            $catName = "Category-".$data['name'].uniqid();
            $data['category_image'] = $catName;
            $this->imageManipulator($file, 300, 300, $catName);


        }

        // if ($category->isDirty('name') || $category->isDirty('featured') || $request->hasFile('category_image')) {
        //     Session::flash('category-updated', 'Category Updated');
        //     $category->save();
        // } else {
        //     Session::flash('category-updated', 'Nothing has been update');
        // }
        $category->update($data);
        Session::flash('category-updated', 'Category Updated');
        return back();
    }

    public function delete(Category $category)
    {
        $imagePath = public_path() . $category->category_image;
        // return $imagePath;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $category->delete();
        Session::flash('category-deleted', 'Deleted category ' . $category->name);
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
