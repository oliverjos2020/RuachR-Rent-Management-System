<x-dashboard.dashboard-master>
    @section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="header">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Property</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">CREATE PROPERTY</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="{{route('dashboard.property.store')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if(session()->has('property-created'))

                                            <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                                role="alert">
                                                <div class="alert-icon">
                                                    <i class="far fa-fw fa-bell"></i>
                                                </div>
                                                <div class="alert-message">
                                                    {{session('property-created')}}
                                                </div>

                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="title">Property Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                                    id="title" placeholder="Property Title" name="title">
                                                @error('title')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="featured-image">Featured Image</label>
                                                <input type="file" id="featured-image"
                                                    class="form-control-file {{$errors->has('featured_image') ? 'is-invalid' : ''}}"
                                                    name="featured_image">
                                                @error('featured_image')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                <small>Featured Image should be: jpg,jpeg,png,bmp
                                                    format</small>
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
                                                <textarea name="description" data-provide="markdown"
                                                    rows="14"></textarea>
                                                @error('description')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category <span
                                                        class="text-danger">*</span></label>
                                                <select name="category_id" id="category" class="form-control">
                                                    @foreach ($category as $categories)
                                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                                    @endforeach

                                                </select>
                                                @error('category')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="Location">Location <span
                                                        class="text-danger">*</span></label>
                                                <select name="location_id" id="location" class="form-control">
                                                    @foreach ($location as $locations)
                                                    <option value="{{$locations->id}}">{{$locations->name}}</option>
                                                    @endforeach
                                                    @error('location')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Amount <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control {{$errors->has('amount') ? 'is-invalid' : ''}}"
                                                    id="amount" placeholder="Amount" name="amount">
                                                @error('amount')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="featured">Make featured property</label>
                                                <select name="featured" id="featured" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="offer">Offer</label>
                                                <select name="offer" id="offer" class="form-control">
                                                    <option value="1">Open</option>
                                                    <option value="0">Closed</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">

                                                <div class="mt-2">
                                                    <input type="file" id="photo_id"
                                                        class="form-control-file {{$errors->has('photo_id') ? 'is-invalid' : ''}}"
                                                        name="photo_id[]" multiple>
                                                    @error('photo_id')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <small>File extension allowed: jpg,jpeg,png,bmp
                                                    format</small>
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
        </div>
    </div>
    @endsection
</x-dashboard.dashboard-master>