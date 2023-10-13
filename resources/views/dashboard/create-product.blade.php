<x-dashboard.dashboard-master>
    @section('content')
<style>
    div#previewImg1 img {
        max-width: 120px;
        padding:10px;
}
</style>
    <div class="header">
        <h1 class="header-title">
            Create Property
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">CREATE PRODUCT</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{route('dashboard.product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    @if(session()->has('product-created'))

                                    <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                        role="alert">
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            {{session('product-created')}}
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
                                            id="title" placeholder="Product Name" name="title">
                                        @error('title')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Product Cover Photo</label>
                                        <input type="file" onchange="previewFile(this);"
                                            class="form-control-file {{$errors->has('featured_image') ? 'is-invalid' : ''}}" id="formFile"
                                            name="featured_image">
                                        @error('featured_image')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                        <small>Featured Image should be: jpg,jpeg,png,bmp
                                            format</small>
                                        <br>
                                        <img id="previewImg" src="/examples/images/transparent.png" class="d-none"
                                            alt="Placeholder" style="max-height:250px;">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Short Description</label>
                                        <textarea name="short_description" id="short-description"
                                            class="form-control {{$errors->has('short_description') ? 'is-invalid' : ''}}"
                                            cols="30" rows="3"></textarea>
                                        @error('short_description')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea name="description" data-provide="markdown" rows="14"></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Regular Price <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('regular_price') ? 'is-invalid' : ''}}"
                                            id="regular_price" placeholder="Regular Price" name="regular_price">
                                        @error('regular_price')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Sale Price <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('sale_price') ? 'is-invalid' : ''}}"
                                            id="sale_price" placeholder="Sale Price" name="sale_price" value="0">
                                        @error('sale_price')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                  
                                   
                                    <div class="form-group">
                                        <label for="featured">Make featured product</label>
                                        <select name="featured" id="featured" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Quantity <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control {{$errors->has('quantity') ? 'is-invalid' : ''}}"
                                            id="quantity" placeholder="Quantity" name="quantity">
                                        @error('quantity')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                  
                                    <div>
                                        <label for="featured">Category</label>
										<select class="form-control select2" data-toggle="select2" name="category_id[]" multiple>
                                            @foreach ($category as $categories)
                                                <option value="{{$categories->id}}">{{$categories->name}}</option>
                                            @endforeach
                                            @error('category_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
										</select>

                                        @error('category_id')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
									</div>
                                    <div class="text-left">

                                        <div class="mt-3">
                                            <label>More Product Photo (select multiple)</label>
                                            <input type="file" id="photo_id" onchange="previewFiles(this);"
                                                class="form-control-file {{$errors->has('photo_id') ? 'is-invalid' : ''}}"
                                                name="photo_id[]" multiple>
                                            @error('photo_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <small>File extension allowed: jpg,jpeg,png,bmp
                                            format</small>
                                        <div id="previewImg1"></div>
                                    </div>

                                </div>
                                
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                    </div>
                    <div class="my-5">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/uploadPreview.min.js')}}"></script>
    <script type="text/javascript">
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
    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#previewImg").removeClass('d-none').animate().show('fast');
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    function previewFiles(input) {
        var preview = $("#previewImg1");
        preview.empty(); // Clear any previous previews

        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $("<img />", {
                        "src": event.target.result,
                        "class": "preview-image"
                    }).appendTo(preview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
    </script>
    @endsection
</x-dashboard.dashboard-master>