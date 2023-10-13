@extends('layouts.app')
@section('content')
        <main class="bg_gray pattern">

            <div class="container margin_60_40">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="sign_up">
                            <div class="head">
                                <div class="title">
                                    <h3>Sign In</h3>
                                </div>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    {{-- <a href="#0" class="social_bt facebook">Sign up with Facebook</a>
                                    <a href="#0" class="social_bt google">Sign up with Google</a> --}}
                                    <div class="divider"><span>Login to continue</span></div>
                                    {{-- <h6>Personal details</h6> --}}
                                    
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
                                        <div class="hideShowPassword-wrapper"
                                            style="position: relative; display: block; vertical-align: baseline; margin: 0px;">
                                            <input
                                                class="form-control @error('password') is-invalid @enderror hideShowPassword-hidden hideShowPassword-field"
                                                placeholder="Password" id="password_sign" name="password"
                                                autocapitalize="off" autocomplete="off" spellcheck="true" type="password"
                                                style="margin: 0px; padding-right: 51.1094px;">
                                            <button type="button"role="button" aria-label="Show Password"
                                                title="Show Password" tabindex="0"
                                                class="my-toggle hideShowPassword-toggle-show" aria-pressed="false"
                                                style="position: absolute; right: 0px; top: 50%; margin-top: -15px; display: none;">Show</button>
                                        </div>
                                        <i class="icon_lock"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn_1 full-width mb_5">Login</button>
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
    @endsection
