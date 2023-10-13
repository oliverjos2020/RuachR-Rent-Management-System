<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function show(Request $request, Category $cat){
        $sortBy = $request->input('sort_by', 'price_asc');
        $perPage = $request->input('per_page', 12);
        $category = $request->input('category', 'na');
        $search = $request->input('q', '');
    
        // Default sorting is by ascending price
        $sortOrder = 'asc';
        $sortColumn = 'regular_price';
    
        if ($sortBy === 'price_desc') {
            $sortOrder = 'desc';
        }
    
        if ($sortBy === 'name_asc') {
            $sortColumn = 'title';
        }
    
        if ($sortBy === 'name_desc') {
            $sortColumn = 'title';
            $sortOrder = 'desc';
        }
    
        // $query = Product::query();
        $query = Product::query()->join('category_product', 'products.id', '=', 'category_product.product_id')->where('is_illustrator', 0);

        if ($category !== 'na') {
            $query->whereIn('category_product.category_id', [$category]);
        }
        
        if ($search) {
            $query->where(function($q) use($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }
    
//       $query = $query->toSql();
// dd($query); 

        $product = $query->select('products.*') // Select all columns from products table
        ->orderBy($sortColumn, $sortOrder)
        ->groupBy('products.id', 'products.user_id', 'products.title', 'products.slug', 'products.short_description','products.description','products.regular_price','products.sale_price','products.SKU','products.stock_status','products.featured','products.quantity','products.featured_image','products.is_illustrator','products.created_at','products.updated_at') // Add slug to GROUP BY clause
        ->paginate($perPage);
        file_put_contents("query.txt",$product);

        $featuredProducts = Product::where('featured', '1')
        ->limit(3)->get();
      
    
        return view('shop', ['product'=>$product, 'sortBy' => $sortBy, 'perPage' => $perPage, 'category' => $category, 'cat' => $cat::all(), 'search' => $search, 'featuredProducts'=>$featuredProducts]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','min:1'],
            'short_description' => ['required','string','min:1','max:255'],
            'description' => ['required','string','min:1'],
            'regular_price' => 'required',
            'sale_price' => '',
            // 'SKU' => 'required',
            // 'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'featured_image' => ['file', 'mimetypes:image/jpeg,image/png,image/bmp,image/webp']
        ]);
    
        $data['slug'] = Str::of(Str::lower(request('title')))->slug('-');
        $data['SKU'] = "SKU-".uniqid();

        if(auth()->user()->userHasRole('Illustrator')){
            $data['is_illustrator'] = 1;
        }else{
            $data['is_illustrator'] = 0;
        }
        
       
    
        if ($file = $request->file('featured_image')) {
            $name = uniqid() . '.' .$file->getClientOriginalName();
            $name = Str::of(Str::lower($name))->slug('-');
            $this->imageManipulator($file, 400, 400, $name);
            $data['featured_image'] = $name;
        } else {
            $name = "avatar.jpg";
            $data['featured_image'] = $name;
        }
    //  dd($data);
        $newProduct = auth()->user()->products()->create($data);
        
        foreach (request('category_id') as $categoryId) {
            $newProduct->categories()->attach($categoryId);
        }
        
        if ($request->has('photo_id')) {
            foreach ($xfile = $request->file('photo_id') as $image) {
                $imageName = '-image-'.time().rand(1,100).'.'.$image->extension();
                $this->imageManipulator($image, 400, 400, $imageName);


                // $image->move(public_path('images'), $imageName);
                Photo::create([
                    'product_id' => $newProduct->id,
                    'file' => $imageName
                ]);
            }
        }
    
        Session::flash('product-created', 'Product created');
        return back();
    }

    public function edit($id, Category $category, Photo $photo){

        $product = Product::where('slug', $id)->first();
        $photo = Photo::where('product_id', $product->id)->get();
        return view('dashboard.edit-product', [
            'photo'=>$photo,
            'product'=>$product, 
            'category'=>$category::all()
        ]);
    }

    public function update(Request $request, $id, Product $product){
        // return $id;
        $data = $request->validate([
            'title' => ['required','string','min:1'],
            'short_description' => ['required','string','min:1','max:255'],
            'description' => ['required','string','min:1'],
            'regular_price' => 'required',
            'sale_price' => 'required',
            // 'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'category_image' => ['file', 'mimetypes:image/jpeg,image/png,image/bmp,image/webp']
        ]);
        $data['slug'] = Str::of(Str::lower(request('title')))->slug('-');
 
        if($file = $request->file('featured_image')){

            $name = $file->getClientOriginalName().time();
            $name = Str::of(Str::lower($name))->slug('-');
            $this->imageManipulator($file, 400, 400, $name);
            // $file->move('images', $name);
            $data['featured_image'] = $name;
    
            }else{
             
            }
       
        $products = auth()->user()->products()->whereId($id)->first();
        $products->categories()->detach();
        // dd($data);

        foreach (request('category_id') as $categoryId) {
            $products->categories()->attach($categoryId);
        }
    

        if($request->has('photo_id')){
            foreach($xfile = $request->file('photo_id')as $image){
                $imageName = '-image-'.time().rand(1,100).'.'.$image->extension();
                $this->imageManipulator($image, 400, 400, $imageName);

                // $image->move(public_path('images'), $imageName);
                Photo::create([
                    'product_id' => $id,
                    'file' => $imageName
                ]);
            }
        }

        if ($products) {
            $newProduct = $products->update($data);
            Session::flash('product-updated', 'Product updated');
            return back();
        } else {
            Session::flash('cant-update', 'You cant update a product that does not belong to you');
            return back();
        }

        
    }


    public function single($slug){
        $product = Product::where('slug', $slug)->with('categories')->first();
    
        $relatedProducts = Product::whereHas('categories', function ($query) use ($product) {
                $query->whereIn('id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
    
        $featuredProducts = Product::where('featured', '1')
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();
    
        $recentProducts = Product::latest()->take(3)->get();
        $photo = Photo::where('product_id', $product->id)->get();
    
        $user = Auth::user(); // Assuming you have an authenticated user
        $isWishlist = $user ? Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->exists() : false;
    
        return view('single', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'featuredProducts' => $featuredProducts,
            'recentProducts' => $recentProducts,
            'photo' => $photo,
            'isWishlist' => $isWishlist
        ]);
    }
    
    
    public function dashboardShow(Product $product){

        $user = Auth::user();
        if ( auth()->user()->userHasRole('Admin') ) {
            $product = Product::where('is_illustrator', 0)->get();
            return view('dashboard.all-product', ['product'=>$product]);
        } else {
            $user_id = auth()->user()->id;
            $product = Product::where('user_id', $user_id)->get();
            return view('dashboard.all-product', ['product' => $product]);
        }
        
    }

    public function illustrations(Product $product){

        $user = Auth::user();
        if ( auth()->user()->userHasRole('Admin') ) {
            $product = Product::where('is_illustrator', 1)->get();
            return view('dashboard.illustrations', ['product'=>$product]);
        } else {
            $user_id = auth()->user()->id;
            $product = Product::where('user_id', $user_id)->get();
            return view('dashboard.illustrations', ['product' => $product]);
        }
        
    }

    public function create(Category $category){
        return view('dashboard.create-product', [
            'category'=>$category::all()
       ]);
    }

    public function destroy($id){

        $product = Product::findOrFail($id);
        $photo = Photo::where('product_id', $id)->get();
        foreach($photo as $photos){
            unlink(public_path() . $photos->file);
        }
        $product->delete();
        Session::flash('product-deleted', "product deleted");
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
