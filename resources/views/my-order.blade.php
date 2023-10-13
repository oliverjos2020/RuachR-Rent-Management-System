<x-home.index-master>
    @section('content')
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Order
                        </li>
                    </ol>
                </div>
            </nav>

        </div>
    </div>

    <div class="container mt-4">
        @if (session()->has('created'))
                    <div class="cart-message">
                        <strong class="single-cart-notice">“{{ session('created') }}”</strong>
                       
                    </div>
                @endif
      
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0 table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        {{-- <th class="status-col">Quantity</th> --}}
                        <th class="action-col">Actions</th>
                        {{-- <th class="status-col">Quantity</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $orders)
                    <tr class="product-row">
                        <td>
                            <figure class="product-image-container">
                               
                                    {{-- <img src="assets/images/products/product-4.jpg" alt="product"> --}}
                                    <img src="{{$orders->product->featured_image}}" alt="product">
                                

                                {{-- <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a> --}}
                            </figure>
                        </td>
                        <td>
                            <h5 class="product-title">
                                <a href="{{route('product.single', $orders->product->slug)}}">{{$orders->product->title}}</a> x {{$orders->qty}}
                            </h5>
                        </td>
                        <td class="price-box">₦{{ number_format($orders->amount, 2) }}</td>
                        {{-- <td>
                            <span class="stock-status">{{$orders->qty}}</span>
                        </td> --}}
                        <td>
                            @if($orders->status == '0')
                            <button href="#" class="btn btn-danger btn-sm">Not Paid </button>
                            <a href="/checkout" class="btn btn-primary btn-sm" title="Quick View" style="padding: 4px 4px 4px 4px">proceed to checkout</a>
                            @elseif($orders->status == '1')
                            <a href="#" class="btn btn-success btn-xs" title="Quick View"> Paid </a>
                            <a href="#" class="btn btn-outline-dark btn-sm mt-0"
                                    data-toggle="modal" data-target="#chatModal" data-id="{{$orders->product_id}}">Post Review</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <div class="alert alert-info text-center">No order placed</div>
                    @endforelse

                    
                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
<div class="container">
                             
                                <div class="modal fade" id="chatModal" tabindex="-1" role="dialog"
                                    aria-labelledby="chatModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="chatModalLabel"><b>POST YOUR EXPERIENCE WITH THIS ITEM</b></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="chat-body">
                                            <form method="POST" action="{{ route('review.store') }}">
                                                 @csrf
                                               
                                                        <div class="form-group">
                                                            <label>Your review <span class="required">*</span></label>
                                                            <textarea cols="5" rows="6" name="message" class="form-control form-control-sm"></textarea>
                                                            <input type="hidden" class="form-control" name="product_id" id="productIDInput" readonly>
                                                        </div>
                                                   
                                            </div>
                                           
                                                
                                                    <div class="modal-footer">

                                                        <button type="submit" id="sendMessage"
                                                            class="btn btn-primary mt-0 mb-1">Send</button>

                                                    </div>
                                                </form>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
        <div class="mb-6"></div>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script>
$(document).ready(function() {
  $('#chatModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var productID = button.data('id'); // Extract the data-id value
    
    $('#productIDInput').val(productID); // Set the value in the input field
  });
});

        </script>
    @endsection
</x-home.index-master>
