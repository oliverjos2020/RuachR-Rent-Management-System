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
          <a href="
          @if(Auth::check())
          {{route('cart.view', Auth()->User())}}
          @else
          #
          @endif
          " class="btn btn-primary position-relative">
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
          </a>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner" style="max-height: 500px;">
        <div class="carousel-item active">
          <img src="img/slide1.jpg" class="d-block w-100" alt="..." style="max-height: 600px;">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="text-shadow:1px 1px rgba(3, 3, 3, 0.5); margin-bottom:7.5rem;text-transform:uppercase; font-family:Open Sans; font-sizes:60px; colors:#333;">Find A Place To Call Home</h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide4.jpg" class="d-block w-100" alt="..." style="max-height: 750px;">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="text-shadow:1px 1px rgba(0,0,0,0.5); margin-bottom:7.5rem;text-transform:uppercase;">Second slide label</h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide5.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="text-shadow:1px 1px rgba(0,0,0,0.5); margin-bottom:7.5rem;text-transform:uppercase;">Third slide label</h1>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="container">
      <div class="row" style="margin-top: 50px">
  
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

          <div class="d-flex" style="overflow:none"><div class="mx-auto">{{$property->links()}}</div></div>
  
          <!-- Pagination -->
          {{-- <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              {{$property->render()}}
            </li>

          </ul> --}}
  
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
    @endsection
</x-home.home-master>