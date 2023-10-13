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
          <button type="button" class="btn btn-primary position-relative">
            <i class="fa fa-cart-plus"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              @forelse ($cart as $carts)
                @if(Auth::check())
                  @if ($carts->user_id == Auth()->user()->id)
                  {{$carts->count()}}
                  @else
                  0
                  @endif
                @else
                  0
                @endif
              @empty
              0
              @endforelse
              <span class="visually-hidden"></span>
            </span>
          </button>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container-fluid" style="background-image:url({{asset('images/bg-background.jpg')}}); background-size:cover; background-position:center; padding:80px;">
        <div class="row">
          <div class="mb-3" style="margin-top: 0px;">
            <h1 class="my-3 text-center" style="background:#6d7075mm; padding:10px; font-family:futura md bt; font-weight:bold; color:rgb(255, 255, 255); text-transform:uppercase;"><strong class="fw-bold text-light">Listings</strong></h1>
            <p class="text-center fw-bold text-light">Your Property, Our Priority and From as low as 50k per year with limited time offer discounts</p>
          </div>
        </div>
      </div>
      
        <!-- Page Content -->
        <div class="container">
      
          <div class="row">
      
            <!-- Blog Entries Column -->
            <div class="col-md-9 my-4">
      
              <!-- Blog Post -->
              <div class="row">
                @foreach ($property as $properties)
                <div class="col-lg-4">
                  <div class="card mb-4 shadow-sm">
                    <a href="
                    @if(auth()->user())
                    {{route('home.single', $properties->id)}}
                    @else
                    /login
                    @endif
                    " style="text-decoration: none;" class="text-dark">
                    <img class="card-img-top" src="{{$properties->featured_image}}" alt="Card image cap">
                    <div class="card-body">
                      <h6 class="card-title">{{Str::limit($properties->title, '22', '...')}}</h6>
                      <p class="card-subtitle mb-2 text-muted" style="font-size:16px">at : {{$properties->location->name}}</p>
                      <p class="card-subtitle mb-2 text-muted" style="font-size:16px"> <span class="badge rounded-pill bg-primary">{{$properties->category->name}}</span></p>
                    </div>
                    <div class="card-footer text-muted">
                      &#8358;{{ number_format($properties->amount, 2, ',', '.') }} &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-outline-primary">Offer: <span class="">{{$properties->offer==1 ? 'Open' : 'Closed'}}</span></button>
                    </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
      
              <!-- Pagination -->
              <div class="d-flex"><div class="mx-auto">{{$property->links()}}</div></div>
      
            </div>
      
            <!-- Sidebar Widgets Column -->
            <div class="col-md-3">
      
              <!-- Search Widget -->
              <div class="card my-4" id="category">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
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
      
              <!-- Side Widget -->
              <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                  You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
              </div>
      
            </div>
      
          </div>
          <!-- /.row -->
      
        </div>
        <!-- /.container -->
      
    @endsection
</x-home.home-master>