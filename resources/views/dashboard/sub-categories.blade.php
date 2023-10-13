<x-dashboard.dashboard-master>
    @section('content')
    <div class="header">
        <h1 class="header-title">
            Sub Categories
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sub-Categories</li>
            </ol>
        </nav>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sub Categories </h5>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{route('dashboard.subcategory.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                @if(session()->has('subcategory-created'))

                                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        {{session('subcategory-created')}}
                                    </div>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach ($category as $categories)
                                        <option value="{{$categories->id}}">{{$categories->name}}</option> 
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" placeholder="Category Name" name="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>                                        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </div>
                            <div class="col-md-9">
                                @if(session()->has('subcategory-deleted'))

                                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        {{session('subcategory-deleted')}}
                                    </div>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                <table id="datatables-basic" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Parent Category</th>
                                            <th>Sub Category</th>
                                            <th>Slug</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategory as $subcategories)
                                            
                                        <tr>
                                            <td>{{$subcategories->id}}</td>
                                            <td>{{$subcategories->category->name}}</td>
                                            <td><a href="{{route('dashboard.editsubcategory', $subcategories->id)}}">{{$subcategories->name}}</a></td>
                                            <td>{{$subcategories->slug}}</td>
                                            <td>
                                                <form action="{{route('dashboard.subcategory.destroy', $subcategories)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Parent Category</th>
                                            <th>Sub Category</th>
                                            <th>Slug</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                </div>
                <div class="my-5">&nbsp;</div>
            </div>
        </div>
    </div>
    </div>
    @endsection
    </x-dashboard.dashboard-master>
    
    