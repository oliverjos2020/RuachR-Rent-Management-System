<x-home.index-master>
    @section('content')
    <div class="container checkout-container">
                <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                    <li>
                        <a href="/cart">Shopping Cart</a>
                    </li>
                    <li class="active">
                        <a href="/checkout">Checkout</a>
                    </li>
                    <li class="disabled">
                        <a href="#">Order Complete</a>
                    </li>
                </ul>


                <div class="checkout-discount">
               
                    <div id="collapseTwo" class="collapse">
                        <div class="feature-box">
                            <div class="feature-box-content">
                                <p>If you have a coupon code, please apply it below.</p>

                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm w-auto" placeholder="Coupon code" required="" />
                                        <div class="input-group-append">
                                            <button class="btn btn-sm mt-0" type="submit">
                                                Apply Coupon
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session()->has('created'))
                <div class="alert alert-success">“{{ session('created') }}” </div>
            @endif

                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>
                                

                                <form id="myform" onsubmit="return false" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fullname
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="text" class="input-sm form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{Auth()->User()->name}}" required />
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="tel" name="phone" value="{{Auth()->user()->phone}}" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" required />
                                        @error('phone')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" name="email" value="{{Auth()->user()->email}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" required />
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Company name (optional)</label>
                                        <input type="text" class="form-control {{$errors->has('company_name') ? 'is-invalid' : ''}}" name="company_name" />
                                        @error('company_name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    

                                    <div class="select-custom">
                                        <label>State
                                            <abbr class="required" title="required">*</abbr></label>
                                        <select class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}" name="state">
                                            <option value="">Select State</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="FCT">Federal Capital Territory</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="Jigawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Kano">Kano</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kogi">Kogi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nasarawa">Nasarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Yobe">Yobe</option>
                                            <option value="Zamfara">Zamfara</option>
                                        </select>
                                        @error('state')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-1 pb-2">
                                        <label>Street address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control {{$errors->has('street') ? 'is-invalid' : ''}}" placeholder="House number and street name" name="street"  />
                                        @error('street')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control {{$errors->has('apartment') ? 'is-invalid' : ''}}" name="apartment" placeholder="Apartment, suite, unite, etc. (optional)" />
                                        @error('apartment')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Town / City
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control {{$errors->has('town') ? 'is-invalid' : ''}}" name="town"  />
                                        @error('town')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Postcode / Zip
                                            <abbr class="required" title="required"></abbr></label>
                                        <input type="text" name="postcode" class="form-control {{$errors->has('postcode') ? 'is-invalid' : ''}}"  />
                                        <input type="hidden" name="total_amount" value="{{$subtotal}}">
                                        @error('postcode')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                
                           </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($cartItem as $cart)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title d-flex">
                                                <img src="{{$cart->product->featured_image}}" style="max-height:40px" alt="product">
                                            &nbsp;&nbsp;&nbsp;&nbsp;<div class="container">{{$cart->product->title}} ×
                                                <span class="product-qty">{{$cart->qty}}</span></div>
                                            </h3>
                                            <input type="hidden" class="form-control" name="product_id[]" value="{{$cart->product_id}}">
                                            <input type="hidden" class="form-control" name="qty[]" value="{{$cart->qty}}">
                                            <input type="hidden" name="user[]" class="form-control" value="{{Auth()->user()->id}}">
                                            <input type="hidden" name="owner[]" class="form-control" value="{{$cart->product->user_id}}">
                                            <input type="hidden" name="amount[]" class="form-control" value="{{$cart->price}}">
                                        </td>

                                        <td class="price-col">
                                            <span>₦{{ number_format($cart->price, 2) }}</span>
                                        </td>
                                    </tr>
                                    @empty
									<tr><td colspan="2">No item available</td></tr>
								@endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Subtotal</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>₦{{number_format($subtotal,2)}}</span>
                                        </td>
                                    </tr>
                                

                                    <tr class="order-total">
                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span>₦{{number_format($subtotal,2)}}</span></b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            {{-- <div class="payment-methods">
                                <h4 class="">Payment methods</h4>
                                <div class="info-box with-icon p-0">
                                    <p>
                                        Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.
                                    </p>
                                </div>
                            </div> --}}
                            <div id="error-messages"></div>
                            <button id="submitbtn" type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                                Place order
                            </button>
                        </form>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
                <!-- End .row -->
            </div>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {

        var messageInterval = null;

        function stopMessageInterval() {
            clearInterval(messageInterval);
        }

        function saveRecord() {
        var data = $("#myform").serialize();
        $.ajax({
            type: "POST",
            url: "{{route('order.create')}}",
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.status == true) {
                    // Handle successful response
                    // alert(response.data.authorization_url);
                    // window.location = response.data.authorization_url
                    window.open(response.data.authorization_url, "_blank");
                    var reference = response.data.reference;
                    $("#submitbtn").text("Payment Gateway Loaded");
                    $("#submitbtn").prop('disabled',true);

                    messageInterval = setInterval(function() {
                    checkReference(reference);
                }, 10000);

                } else {
                    alert(response.response_message);
                    $("#submitbtn").text("PLACE ORDER");
                    $("#submitbtn").prop('disabled',false);
                }
            }, 
            error: function(xhr, status, error) {
                if (xhr.responseText) {
                    var errorMessage = JSON.parse(xhr.responseText);
                    if (errorMessage.errors) {
                        var errorDiv = $('#error-messages');
                        errorDiv.empty(); // Clear previous error messages
                        
                        $.each(errorMessage.errors, function(field, errors) {
                            $.each(errors, function(index, error) {
                                errorDiv.append('<p class="alert alert-danger">' + error + '</p>');
                                $("#submitbtn").text("PLACE ORDER");
                                $("#submitbtn").prop('disabled',false);
                            });
                        });
                    } else {
                        alert('Error: ' + xhr.responseText);
                    }
                } else {
                    alert('An error occurred: ' + error);
                }
            }
        });

    }

    function updateAccount(reference){
        var url = "{{ route('update.account', ':reference') }}";
        url = url.replace(':reference', reference);
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                // alert(response.message);
                stopMessageInterval();
                Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            }).then(function(result) {
                // Redirect the user to another page
                window.location.href = "/cart";
            });
            }
        });
    }

    function checkReference(reference){
        // console.log(reference);
        $.ajax({
            type: "POST",
            url: "{{route('order.confirm')}}",
            data:  {
                        reference: reference,
                        _token: '{{ csrf_token() }}',
                    },
            dataType: "json",
            success: function(response) {
                
                console.log(response);
                var status = response.data.status;
                if(status=='success'){
                    updateAccount(reference);
                    alert("Kindly wait confirming payment... ");
                }

            }
        });

    }

            $("#submitbtn").click(function() {
                $("#submitbtn").text("Loading Please Wait ...");
                $("#submitbtn").prop('disabled',true);
                saveRecord();
            });
        });
    
        </script>
        
    @endsection
</x-home.index-master>