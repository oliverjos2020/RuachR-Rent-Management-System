<x-home.index-master>
    @section('content')
			<div class="page-header">
				<div class="container d-flex flex-column align-items-center">
					<nav aria-label="breadcrumb" class="breadcrumb-nav">
						<div class="container">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									Become An Illustrator
								</li>
							</ol>
						</div>
					</nav>

					<h1>Become An Illustrator</h1>
				</div>
			</div>

			<div class="container reset-password-container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="feature-box border-top-primary">
							<div class="feature-box-content">
						

									@if(session()->has('illustrator-created'))
									<div class="cart-message">
										<strong class="single-cart-notice"></strong>
										<span>{{session('illustrator-created')}}</span>
									</div>
								@endif
								<form class="mb-0" action="{{route('illustrator.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
									
									<div class="form-group mb-0">
										<label for="firstname" class="font-weight-normal">Firstname <span class="text-danger">*</span></label>
										<input type="text" class="form-control {{$errors->has('firstname') ? 'is-invalid' : ''}}" id="firstname" name="firstname"
											requireds />
											@error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="lastname" class="font-weight-normal">Lastname <span class="text-danger">*</span></label>
										<input type="text" class="form-control {{$errors->has('lastname') ? 'is-invalid' : ''}}" id="lastname" name="lastname"
											requireds />
											@error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
									</div>
									<div class="form-group mb-0">
										<label for="email" class="font-weight-normal">Email Address <span class="text-danger">*</span></label>
										<input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email"
											requireds />
											@error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="phone" class="font-weight-normal">Phone Number <span class="text-danger">*</span></label>
										<input type="tel" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" id="phone" name="phone"
											requireds />
											@error('phone')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="shop-name" class="font-weight-normal">Shop Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control {{$errors->has('shop_name') ? 'is-invalid' : ''}}" id="shop-name" name="shop_name"
											requireds />
											@error('shop_name')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="shop-address" class="font-weight-normal">Shop Address <span class="text-danger">*</span></label>
										<input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="shop-address" name="address"
											requireds />
											@error('address')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="cac" class="font-weight-normal">CAC Document <span class="text-danger">*</span></label>
										<input type="file" class="form-control-file {{$errors->has('cac') ? 'is-invalid' : ''}}" id="cac" name="cac"
											requireds />
											@error('cac')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-group mb-0 mt-2">
										<label for="password" class="font-weight-normal">Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password"
											requireds />
											@error('password')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-group mb-0">
										<label for="confirm-password" class="font-weight-normal">Confirm Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" id="confirm-password" name="password_confirmation"
											requireds />
											@error('password_confirmation')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
									</div>
                                    <div class="form-footer">
										<div class="custom-control custom-checkbox mb-0">
											<input type="checkbox" class="custom-control-input {{$errors->has('agreement') ? 'is-invalid' : ''}}" id="agreement" name="agreement" />
											<label class="custom-control-label mb-0" for="agreement">I Agree to The Seller Policy ,Support Policy</label>
											@error('agreement')
											<div class="invalid-feedback">{{$message}}</div>
											@enderror
										</div>

									</div>

									<div class="form-footer mb-2">
										
										<button type="submit"
											class="btn btn-md btn-primary form-footer-right font-weight-normal text-transform-none mr-0">
											Register
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

    @endsection
</x-home.index-master>