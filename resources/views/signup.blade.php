<x-home.auth-master>
    @section('content')
        <main class="bg_gray pattern">

            <div class="container margin_60_40">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="sign_up">
                            <div class="head">
                                <div class="title">
                                    <h3>Sign Up</h3>
                                </div>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <form onsubmit="return false" id="myform">
                                    @csrf
                                    {{-- <a href="#0" class="social_bt facebook">Sign up with Facebook</a>
                                    <a href="#0" class="social_bt google">Sign up with Google</a> --}}
                                    <div class="divider"><span>Fill in the form below with your details</span></div>
                                    {{-- <h6>Personal details</h6> --}}
                                    <div class="form-group">
                                        <input class="form-control @error('name') is-invalid @enderror"
                                            placeholder="First and Last Name" name="name" value="{{ old('name') }}"
                                            autocomplete="name" autofocus>
                                        <i class="icon_pencil"></i>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email Address" name="email">
                                        <i class="icon_mail"></i>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Mobile Number" name="phone">
                                        <i class="icon_phone"></i>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                        <div class=""
                                            style="position: relative; display: block; vertical-align: baseline; margin: 0px;">
                                            <input
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password"
                                                autocapitalize="off" autocomplete="off" spellcheck="true" type="password"
                                                style="margin: 0px; padding-right: 51.1094px;">
                                            
                                        </div>
                                        <i class="icon_lock"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group add_bottom_15">
                                        <div class="hideShowPassword-wrapper"
                                            style="position: relative; display: block; vertical-align: baseline; margin: 0px;">
                                            <input class="form-control hideShowPassword-hidden hideShowPassword-field"
                                                placeholder="Confirm Password" id="password_sign"
                                                name="password_confirmation" autocapitalize="off" autocomplete="off"
                                                spellcheck="true" type="password"
                                                style="margin: 0px; padding-right: 51.1094px;">
                                            <button type="button" role="button" aria-label="Show Password"
                                                title="Show Password" tabindex="0"
                                                class="my-toggle hideShowPassword-toggle-show" aria-pressed="false"
                                                style="position: absolute; right: 0px; top: 50%; margin-top: -15px; display: none;">Show</button>
                                        </div>
                                        <i class="icon_lock"></i>
                                    </div>
                                    <div id="error-messages"></div>
                                    <button type="submit" id="submitbtn" onclick="saveRecord()" class="btn_1 full-width mb_5">Sign up Now</button>
                                </form>
                            </div>
                        </div>
                        <!-- /box_booking -->
                    </div>
                    <!-- /col -->

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->

        </main>
        <script>
            function saveRecord() {
            var data = $("#myform").serialize();
            $.ajax({
            type: "POST",
            url: "{{ route('user.create') }}",
            data: data,
            dataType: "json",
            success: function(response) {
            console.log(response);
            if (response.responseCode == 200) {
            // Handle successful response
            // alert(response.data.authorization_url);
            // window.location = response.data.authorization_url
            window.location='/login';
            // window.open(response.data.authorization_url, "_blank");
            // var reference = response.data.reference;
            // $("#submitbtn").text("Payment Gateway Loaded");
            // $("#submitbtn").prop('disabled',true);
            
            // messageInterval = setInterval(function() {
            // checkReference(reference);
            // }, 10000);
            
            } else {
            alert(response.response_message);
            $("#submitbtn").text("Sign up now");
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
            $("#submitbtn").text("Sign up now");
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
        </script>
    @endsection
</x-home.auth-master>
