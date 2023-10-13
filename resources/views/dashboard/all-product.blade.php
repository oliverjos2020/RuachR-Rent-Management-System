<x-dashboard.dashboard-master>
    @section('content')
    <div class="col-12">
        <div class="card ">
            <div class="card-header">
                <h5 class="card-title mb-0">Manage Products</h5>
            </div>
            <div class="card-body table-responsive">
                @if(session()->has('product-deleted'))
                <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{session('product-deleted')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif 
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            @if (auth()->user()->userHasRole('Admin'))
                            <th>Owner</th>
                            @endauth
                            <th>Title</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($product as $products)
                             
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="{{$products->featured_image ? $products->featured_image : 'avatar.png'}}" height="50px" alt=""></td>
                            @if (auth()->user()->userHasRole('Admin'))<td>{{$products->user->name}}</td>@endif
                            <td><a href="{{route('dashboard.edit-product', $products->slug)}}">{{Str::limit($products->title, '20', '...')}}</a></td>
                            <td>{{$products->quantity < 1 ? 'Out of Stuck' : 'Instock'}}</td>
                            <td>₦{{ number_format($products->regular_price, 2, ',', '.') }}</td>
                            <td>@foreach ($products->categories as $category)
                                {{ $category->name }}, 
                            @endforeach</td>
                            <td>{{$products->created_at->diffForHumans()}}</td>
                            <td>
                                @if(!auth()->user()->userHasRole('Admin'))
                                @if(auth()->user()->id == $products->user_id)
                                <form action="{{route('dashboard.product.destroy', $products->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                                @else
                                <form action="{{route('dashboard.product.destroy', $products->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Photo</th>
                            @if (auth()->user()->userHasRole('Admin'))<th>Owner</th>@endif
                            <th>Title</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
    @endsection
    </x-dashboard.dashboard-master>
    
    