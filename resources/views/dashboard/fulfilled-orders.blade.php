<x-dashboard.dashboard-master>
    @section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Fulfilled Orders</h5>
            </div>
            <div class="card-body table-responsive">
                @if(session()->has('updated'))
                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{session('updated')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <table id="example" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Street</th>
                            <th>Town</th>
                            <th>Apartment</th>
                            <th>Postcode</th>
                            <th>Created</th>
                            <th>Fulfillment</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($order as $orders)
                             
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$orders->name}}</td>
                            <td>{{$orders->phone}}</td>
                            <td><a href="{{route('product.single', $orders->product->slug)}}" target="_blank">{{$orders->product->title}}</a></td>
                            <td>{{$orders->qty}}</td>
                            <td>₦{{ number_format($orders->amount, 2, ',', '.') }}</td>
                            <td>{{$orders->street}}</td>
                            <td>{{$orders->town }}</td>
                            <td>{{$orders->apartment}}</td>
                            <td>{{$orders->postcode}}</td>
                            {{-- <td>{{$orders->created_at->diffForHumans()}}</td> --}}<td></td>
                            <td>
                                @if($orders->fulfillment == 0)
                                <a href="{{route('fullfilled.update', ['id' => $orders->id, 'fulfillment' => 1])}}" class="btn btn-danger btn-sm">Awaiting</a>
                                @else
                                <a href="{{route('fullfilled.update', ['id' => $orders->id, 'fulfillment' => 0])}}" class="btn btn-success btn-sm">Fulfilled</a>
                                @endif
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Street</th>
                            <th>Town</th>
                            <th>Apartment</th>
                            <th>Postcode</th>
                            <th>Created</th>
                            <th>Fulfillment</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
    @endsection
    </x-dashboard.dashboard-master>
    
    