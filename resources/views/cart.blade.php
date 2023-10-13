<x-home.index-master>
    @section('content')
    <div class="container">
				<ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
					<li class="active">
						<a>Shopping Cart</a>
					</li>
					<li>
						<a>Checkout</a>
					</li>
					<li class="disabled">
						<a>Order Complete</a>
					</li>
				</ul>
				@if(session()->has('cart-added'))
				
					<div class="alert alert-success">“{{session('cart-added')}}” <span> has been added to your cart.</span></div>
				@endif
				@if(session()->has('cart-deleted'))
				
					<div class="alert alert-info">“{{session('cart-deleted')}}” <span> has been removed from your cart.</span></div>
				@endif

				<div class="row">
					<div class="col-lg-8">
						<div class="cart-table-container">
							<table class="table table-cart">
								<thead>
									<tr>
										<th class="thumbnail-col"></th>
										<th class="product-col">Product</th>
										<th class="price-col">Price</th>
										<th class="qty-col text-center">Quantity</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totalQuantity = 0;
									?>
								@forelse($cartItem as $cart)
									<tr class="product-row">
										<td>
											<figure class="product-image-container">
												<a href="{{route('product.single', $cart->product->slug)}}" class="product-image">
													<img src="{{$cart->product->featured_image}}" alt="product">
												</a>
												<form action="{{route('cart.destroy', $cart->id)}}" method="post">
												@csrf
                                    			@method('DELETE')
												<!-- <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a> -->
												<button class="btn-remove icon-cancel" title="Remove Product" style="border:none"></button>
												</form>
											</figure>
										</td>
										<td class="product-col">
											<h5 class="product-title">
												<a href="{{route('product.single', $cart->product->slug)}}">{{$cart->product->title}}</a>
											</h5>
										</td>
										<td>₦{{ number_format($cart->price, 2) }}</td>
										<td class="text-center">
										<form id="form-{{ $cart->id }}" method="POST">
											@csrf
										<div class="product-single-qty">
												<input class="horizontal-quantity form-control" type="text" name="qty" value="{{$cart->qty}}" onchange="updateCart({{ $cart->id }})">
											</div>
										</td>
										</form>

									
									</tr>
									@empty
									<tr><td colspan="5">No item in your cart</td></tr>
								@endforelse
								</tbody>

							</table>
						</div><!-- End .cart-table-container -->
					</div><!-- End .col-lg-8 -->

					<div class="col-lg-4">
						<div class="cart-summary">
							<h3>CART TOTALS</h3>

							<table class="table table-totals">
								<tbody>
									<tr>
										<td>Subtotal</td>
										<td >₦<span id="total-amount">{{number_format($subtotal,2)}}</span></td>
									</tr>

								</tbody>

								<tfoot>
									<tr>
										<td>Total</td>
										<td><span id="total-amount-b">
										
										{{number_format($subtotal,2)}}</span></td>
									</tr>
								</tfoot>
							</table>

							<div class="checkout-methods">
								<a href="/checkout" class="btn btn-block btn-dark">Proceed to Checkout
									<i class="fa fa-arrow-right"></i></a>
							</div>
						</div><!-- End .cart-summary -->
					</div><!-- End .col-lg-4 -->
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