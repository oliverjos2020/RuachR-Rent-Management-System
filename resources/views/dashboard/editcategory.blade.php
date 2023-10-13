<x-dashboard.dashboard-master>
    @section('content')
    <div class="header">
        <h1 class="header-title">
            Category
        </h1>
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
                    <h5 class="card-title mb-0">Edit category: {{$category->name}}</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{route('dashboard.category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    @if(session()->has('category-updated'))

                                    <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                        role="alert">
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            {{session('category-updated')}}
                                        </div>

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                            class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name"
                                            placeholder="Name" value="{{$category->name}}" name="name">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Category Photo</label><br>
                                        
                                        <img alt="" src="{{$category->category_image}}" class="img-responsive mt-2 mb-4" width="150" height="150" />
                                        <input type="file" onchange="previewFile(this);"
                                            class="form-control-file {{$errors->has('category_image') ? 'is-invalid' : ''}}"
                                            id="formFile" name="category_image">
                                        @error('category_image')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                        <small>Featured Image should be: jpg,jpeg,png,bmp
                                            format</small>
                                        <br>
                                        <img id="previewImg" src="/examples/images/transparent.png" class="d-none"
                                            alt="Placeholder" style="max-height:250px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="featured">Make featured category</label>
                                        <select name="featured" id="featured" class="form-control">
                                            <option value="1" {{$category->featured == '1' ? 'selected' : ''}}>Yes</option>
                                            <option value="0" {{$category->featured == '0' ? 'selected' : ''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <table id="datatables-basic" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Featured</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)

                            <tr>
                                <td><img src="{{$category->category_image ? $category->category_image : 'avatar.png'}}"
                                        height="50px" alt=""></td>

                                <td><a href="{{route('dashboard.editcategory', $category->id)}}">{{$category->name}}</a>
                                </td>
                                <td>{{$category->slug}}</td>

                                <td>{{$category->featured=="1"?"Yes":"No"}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Featured</th>
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
    @endsection
</x-dashboard.dashboard-master>