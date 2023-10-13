<x-dashboard.dashboard-master>
    @section('content')
    <div class="header">
        <h1 class="header-title">
            Sales
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales </h5>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">
                            <form action="{{route('dashboard.saletimer.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Sales End</label>
                                    <input type="date" name="sales_end" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sales Timer Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Set</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-9 table-responsive">
                            @if(session()->has('timer-created'))

                            <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    {{session('timer-created')}}
                                </div>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if(session()->has('status'))

                            <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    {{session('status')}}
                                </div>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            <table class="table table-bordered">
                                @foreach ($timer as $timers)
                                <tr>
                                    <td>Sales Expiring [{{$timers->sales_end}}]</td>
                                    @if($timers->status == 0)
                                    <td><a class="btn btn-danger btn-sm"
                                            href="{{route('dashboard.sales.status', '1')}}">Inactive</a></td>
                                    @elseif($timers->status == 1)
                                    <td><a class="btn btn-success btn-sm"
                                            href="{{route('dashboard.sales.status', '0')}}">Active</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Owner</th>
                                        <th>Title</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $products)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><img src="{{$products->featured_image ? $products->featured_image : 'avatar.png'}}"
                                                height="50px" alt=""></td>
                                        <td>{{$products->user->name}}</td>
                                        <td><a href="{{route('dashboard.edit-product', $products->id)}}">{{Str::limit($products->title, '20', '...')}}</a>
                                        </td>
                                        <td>{{$products->stock_status}}</td>
                                        <td>₦{{ number_format($products->regular_price, 2, ',', '.') }}</td>
                                        <td>
                                            @foreach ($products->categories as $category)
                                            {{$category->name}}
                                            @endforeach
{{-- 
                                            @foreach ($products->categories as $category)
                                            <a href="/shop?category={{$category->id}}" class="product-category">category: {{$category->name}}</a>
                                            @endforeach --}}
                                        </td>
                                        <td>
                                            <a class="btn btn-dark btn-sm"
                                                href="{{route('dashboard.sales.remove', $products->id)}}">Remove</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Owner</th>
                                        <th>Title</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Remove</th>
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