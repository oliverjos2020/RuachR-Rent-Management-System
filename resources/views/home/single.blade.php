<x-home.home-master>
    @section('content')
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('img/logo.png')}}" style="max-height:50px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('dashboard.index')}}">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('home.listing')}}">Listings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ">Partner</a>
            </li>
            <li class="nav-item">
              <form action="/logout" method="post">
              @csrf
                <button type="submit" class="btn btn-outline-dark">Logout</button>
            </form>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#category">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('home.listing')}}">Listings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ">Partner</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            @endif


          </ul>
          <a href="
          @if(Auth::check())
          {{route('cart.view', Auth()->User())}}
          @else
          #
          @endif
          "
          class="btn btn-primary position-relative">
            <i class="fa fa-cart-plus"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

              {{$cart->count()}}

            </span>
          </a>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div style="position: relative">
        <div class="row" style="background-image:url({{asset('images/bg-background.jpg')}}); background-size:cover; background-position:center; padding:130px;">
            <h1 style="background:#6d7075mm; padding:10px; font-family:futura md bt; font-weight:bold; color:rgb(255, 255, 255); text-transform:uppercase;" class="text-center container">{{$property->title}}</h1>
        </div>
    </div>

    <div class="container">
        <div class="row" style="margin-top: 50px">
            <div class="col-md-8 my-4 container">
                <div class="row">
                    <div>
                      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{$property->featured_image}}" class="d-block w-100" alt="...">
                          </div>
                          @foreach ($photo as $photos)
                          <div class="carousel-item">
                            <img src="{{$photos->file}}" class="d-block w-100" alt="...">
                          </div>
                          @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>

                    </div>

                    <h5 style="font-family: Open Sans; font-weight:bold; font-size:30px; margin-top:15px;">{{$property->title}} </h5>
                    <hr>


                    <h6>by <span class="text-primary">{{$property->user->name}}</span> Posted {{$property->created_at->diffForHumans()}}</h6>
                    <hr class="my-2">
                    <h6>Price : &#8358;{{ number_format($property->amount, 2, ',', '.') }}</h6>
                    <hr class="my-1">
                    <div class="container my-1">
                        <div class="text-justify" style="text-align:justify">
                            {{$property->description}}
                        </div>
                    </div>
                </div>
            </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">

            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item">Price : &#8358;{{ number_format($property->amount, 2, ',', '.') }}</li>
                <li class="list-group-item"><i class="fa fa-check"></i> Quality assured by RentApp</li>
                <li class="list-group-item"><i class="fa fa-clock-o"></i> 24/7 Customer Support</li>
                <li class="list-group-item"><i class="fa fa-history"></i> Posted {{$property->created_at->diffForHumans()}}</li>
                <li class="list-group-item"><i class="fa fa-tag"></i> category : <span class="badge rounded-pill bg-primary">{{$property->category->name}}</span></li>
                <li class="list-group-item"><i class="fa fa-map-marker"></i> Location : <span class="badge rounded-pill bg-primary">{{$property->location->name}}</span></li>
              </ul>
            </div>
          </div>

          <div class="card my-4">
            <h5 class="card-header">Cart</h5>
            <div class="card-body">
              @if(session()->has('cart-created'))
              <div class="alert alert-success">
                {{session('cart-created')}}
            </div>
              @elseif (session()->has('cart-deleted'))
              <div class="alert alert-danger">
                {{session('cart-deleted')}}
            </div>
              @endif

              @forelse ($cartbtn as $carts)
              @if($property->id == $carts->property_id)
              <form method="POST" action="{{route('cart.destroy', $carts->id)}}">
                @csrf
                @method("DELETE")
                <input type="hidden" name="property_id" class="form-control" value="{{$property->id}}">
                <input type="hidden" name="payment" class="form-control" value="0">


                <button class="btn btn-success position-relative" type="submit">Added to Cart <i class="fa fa-cart-plus"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    @if(Auth::check())
                      {{$cart->count()}}
                    @else
                      0
                    @endif

                  <span class="visually-hidden"></span>
                </span>
              </button>

                <button type="button" class="btn btn-primary position-relative mx-4">
                  Pay Now
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    Coming soon

                  </span>
                </button>
              </form>
              @else
              <form method="POST" action="{{route('cart.store')}}">
                @csrf
                {{$property->id}}<br>
                {{$cartbtn}}<br>
                <input type="hidden" name="property_id" class="form-control" value="{{$property->id}}">
                <input type="hidden" name="payment" class="form-control" value="0">
                <button class="btn btn-primary position-relative" type="submit">Add to Cart <i class="fa fa-cart-plus"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    @if(Auth::check())
                      {{$cart->count()}}
                    @else
                      0
                    @endif

                  <span class="visually-hidden"></span>
                </span>
              </button>

                <button type="button" class="btn btn-primary position-relative mx-4">
                  Pay Now
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    Coming soon

                  </span>
                </button>
              </form>
              @endif
              @empty
              <form method="POST" action="{{route('cart.store')}}">
                @csrf
                <input type="hidden" name="property_id" class="form-control" value="{{$property->id}}">
                <input type="hidden" name="payment" class="form-control" value="0">
                <input type="hidden" name="amount" class="form-control" value="{{$property->amount}}">
                <button class="btn btn-primary position-relative" type="submit">Add to Cart <i class="fa fa-cart-plus"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    @if(Auth::check())
                      {{$cart->count()}}
                    @else
                      0
                    @endif

                  <span class="visually-hidden"></span>
                </span>
              </button>

                <button type="button" class="btn btn-primary position-relative mx-4">
                  Pay Now
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    Coming soon

                  </span>
                </button>
            </form>
              @endforelse


            </div>
          </div>
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Inspection</h5>
            <div class="card-body">
                <p>Contact : +2347062902972 after a successful payment to schedule a time for your inspection</p>
                Inspection fee <span class="badge rounded-pill bg-primary">&#8358;5,000</span><br><br>
                <form method="POST" action="{{route('cart.inspection')}}">
                    @csrf
                    <input type="hidden" name="property_id" class="form-control" value="{{$property->id}}">
                    <input type="hidden" name="payment" class="form-control" value="0">
                    <input type="hidden" name="amount" class="form-control" value="5000">
                    <button class="btn btn-primary position-relative" type="submit">Pay for inspection
                  </button>

                </form>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    @foreach ($category as $categories)
                    <li>
                      <a href="{{route('home.sort', $categories->id)}}">{{$categories->name}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card my-4">
            <h5 class="card-header">Locations</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    @foreach ($location as $locations)
                    <li>
                      <a href="{{route('home.location', $locations->id)}}">{{$locations->name}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    @endsection
</x-home.home-master>
