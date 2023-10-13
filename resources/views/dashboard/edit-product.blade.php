<x-dashboard.dashboard-master>
    @section('content')
    <div class="header">
        <h1 class="header-title">
            Edit Product
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
            </ol>
        </nav>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">EDIT PRODUCT</h5>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{route('dashboard.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-md-8">
                                    @if(session()->has('product-updated'))

                                    <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                        role="alert">
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            {{session('product-updated')}}
                                        </div>

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @elseif(session()->has('cant-update'))
                                    <div class="alert alert-warning alert-outline-coloured alert-dismissible"
                                        role="alert">
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            {{session('cant-update')}}
                                        </div>

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="title">Product Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                            id="title" placeholder="Product Name" name="title" value="{{$product->title}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="featured-image">Product Cover Photo</label><br>
                                        <img alt="" src="{{$product->featured_image}}" class="img-responsive mt-2 mb-4" width="150" height="150" />
                                        <input type="file" id="featured-image" onchange="previewFile(this);"
                                            class="form-control-file file-input {{$errors->has('featured_image') ? 'is-invalid' : ''}}"
                                            name="featured_image">
                                        @error('featured_image')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                        <small>Featured Image should be: jpg,jpeg,png,bmp
                                            format</small>
                                        <br>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Short Description</label>
                                        <textarea name="short_description" id="short-description"
                                            class="form-control {{$errors->has('short_description') ? 'is-invalid' : ''}}"
                                            cols="30" rows="3">{{$product->short_description}}"</textarea>
                                        @error('short_description')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea name="description" data-provide="markdown" rows="14">{{$product->description}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Regular Price <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('regular_price') ? 'is-invalid' : ''}}"
                                            id="regular_price" placeholder="Regular Price" name="regular_price" value="{{$product->regular_price}}">
                                        @error('regular_price')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Sale Price <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('sale_price') ? 'is-invalid' : ''}}"
                                            id="sale_price" placeholder="Sale Price" name="sale_price" value="{{$product->sale_price}}">
                                        @error('sale_price')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="title">SKU <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control {{$errors->has('SKU') ? 'is-invalid' : ''}}" id="SKU"
                                            placeholder="SKU" name="SKU" value="{{$product->SKU}}">
                                        @error('SKU')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div> --}}
                                  
                                    <div class="form-group">
                                        <label for="featured">Make featured product</label>
                                        <select name="featured" id="featured" class="form-control">
                                            <option {{$product->featured == '1' ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$product->featured == '0' ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Quantity <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('quantity') ? 'is-invalid' : ''}}"
                                            id="quantity" placeholder="Quantity" name="quantity" value="{{$product->quantity}}">
                                        @error('quantity')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category <span class="text-danger">*</span></label> 
                                        <select id="category" class="form-control select2" data-toggle="select2" name="category_id[]" multiple>
                                            @foreach ($category as $categories)
                                                @if ($product->categories->contains($categories->id))
                                                    <option selected value="{{$categories->id}}">{{$categories->name}}</option>
                                                @else
                                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>


                                </div>
                            <div class="col-md-4">
                                <div class="text-left">
                                    @foreach ($photo as $photos)
                                    <img alt="" src="{{$photos->file}}" class="img-responsive mt-2"
                                        width="128" height="128" />
                                         @endforeach
                                    <div class="mt-2">
                                        <label>More Product Photo</label>
                                        <input type="file" name="photo_id[]" id="photo_id" class="form-control-file {{$errors->has('photo_id') ? 'is-invalid' : ''}}" multiple>
                                        @error('photo_id')
                                        <div class="invalid-feedback">{{$message}}</div>                                        
                                    @enderror
                                    </div>
                                    <small>File extension allowed: jpg,jpeg,png,bmp
                                        format</small>
                                       
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
                <div class="my-5">&nbsp;</div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script>
         $(function() {
            $(".select2").each(function() {
				$(this)
					.wrap("<div class=\"position-relative\"></div>")
					.select2({
						placeholder: "Select category",
						dropdownParent: $(this).parent()
					});
			})
        });
    </script>
    @endsection
    </x-dashboard.dashboard-master>
    
    