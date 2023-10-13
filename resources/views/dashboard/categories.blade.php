<x-dashboard.dashboard-master>
    @section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="header">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Category </h5>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if(session()->has('category-created'))

                                            <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                                role="alert">
                                                <div class="alert-icon">
                                                    <i class="far fa-fw fa-bell"></i>
                                                </div>
                                                <div class="alert-message">
                                                    {{session('category-created')}}
                                                </div>

                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                    class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                                    id="name" placeholder="Category Name" name="name">
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Category Photo</label>
                                                <input type="file" onchange="previewFile(this);"
                                                    class="form-control-file {{$errors->has('category_image') ? 'is-invalid' : ''}}"
                                                    id="formFile" name="category_image">
                                                @error('category_image')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                <small>Featured Image should be: jpg,jpeg,png,bmp
                                                    format</small>
                                                <br>
                                                <img id="previewImg" src="/examples/images/transparent.png"
                                                    class="d-none" alt="Placeholder" style="max-height:250px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="featured">Make featured category</label>
                                                <select name="featured" id="featured" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                @if(session()->has('category-deleted'))

                                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        {{session('category-deleted')}}
                                    </div>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>

                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Featured</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $categories)

                                            <tr>
                                                <td><img src="{{$categories->category_image ? $categories->category_image : 'avatar.png'}}"
                                                        height="50px" alt=""></td>

                                                <td><a
                                                        href="{{route('dashboard.editcategory', $categories->id)}}">{{$categories->name}}</a>
                                                </td>
                                                <td>{{$categories->slug}}</td>
                                                <td>{{$categories->featured=="1"?"Yes":"No"}}</td>
                                                <td>
                                                    <form action="{{route('dashboard.category.destroy', $categories)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>

                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Featured</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="my-5">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript">
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
    </script>
    @endsection
</x-dashboard.dashboard-master>