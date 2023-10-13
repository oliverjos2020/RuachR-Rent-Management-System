<x-home.index-master>
    @section('content')
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a>Wishlist Cart</a>
            </li>
            <!-- <li>
                <a>Checkout</a>
            </li>
            <li class="disabled">
                <a>Order Complete</a>
            </li> -->
        </ul>

        @if(session()->has('wishlist-deleted'))

        <div class="alert alert-warning">“{{session('wishlist-deleted')}}” <span> has been removed from your
                wishlist.</span></div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table-container">
                    <table class="table table-cart table-sm">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col text-center">Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($wishlist as $wishlists)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{route('product.single', $wishlists->product->slug)}}"
                                            class="product-image">
                                            <img src="{{$wishlists->product->featured_image}}" alt="product">
                                        </a>
                                        <form action="{{route('wishlist.remove', $wishlists->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <!-- <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a> -->
                                            <button class="btn-remove icon-cancel" title="Remove Product"
                                                style="border:none"></button>
                                        </form>
                                    </figure>
                                </td>
                                <td class="product-col">
                                    <h5 class="product-title">
                                        <a
                                            href="{{route('product.single', $wishlists->product->slug)}}">{{$wishlists->product->title}}</a>
                                    </h5>
                                </td>
                                <td>${{ number_format($wishlists->product->regular_price, 2) }}</td>
                                <td class="text-center">
                                <form method="POST" action="{{route('wishlist.migrate')}}" style="margin-bottom:0px !important">
                                        @csrf
                                      
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control form-control-sm" type="text" name="qty">
                                    </div>
                                </td>
                                <td>
                                        <input type="hidden" name="product_id" value="{{$wishlists->product->id}}" class="form-control">
                                        <input type="hidden" name="wish_id" value="{{$wishlists->id}}" class="form-control">
                                        <input type="hidden" name="product_name" value="{{$wishlists->product->title}}" class="form-control">
                                        <input type="hidden" name="price" value="{{$wishlists->product->regular_price}}" class="form-control">
                                        <button class="btn btn-dark btn-sm product-type-simple btn-shop"> ADD TO CART</button>
                                </td>
                                </form>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No item in your wishlist</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div>
    <script>
    function updateCart(id) {
        var form = document.getElementById('form-' + id);
        var qty = form.querySelector('input[name="qty"]').value;
        // var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                id: id,
                qty: qty,
                _token: _token
            },
            success: function(response) {
                // Update the total amount in the cart view
                var totalAmount = response.totalAmount;
                document.getElementById('total-amount').innerHTML = totalAmount;
                document.getElementById('total-amount-b').innerHTML = totalAmount;
            }
        });
    }
    </script>
    @endsection
</x-home.index-master>