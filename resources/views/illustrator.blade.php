<x-home.index-master>
    @section('content')
        <main class="main">
            {{-- <div class="category-banner-container bg-gray">
                <div class="category-banner banner text-uppercase"
                    style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
                    <div class="container position-relative">
                        <div class="row">
                            <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                                <h3>Illustrators<br></h3>
                                <a href="/illustrator" class="btn btn-dark">Register as an Ilustrator</a>
                            </div>
                            <div class="pl-lg-3 col-md-4 offset-md-0 offset-1 pt-3">
                                <div class="coupon-sale-content">
                                    <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">Exclusive COUPON</h4>
                                    <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0"><i class="ls-0">UP TO</i><b
                                            class="text-dark">₦10,000</b> OFF</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="container mb-4 mt-2">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Illustrations</a></li>
                    </ol>
                </nav>

                <div class="row">
               
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($illustrator as $illustrators)
                            <div class="col-md-3">
                                <div class="card" style="width: x18rem;">
                                    <img src="{{$illustrators->featured_image}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ Str::limit($illustrators->title, '15', '...') }}</h5>
                                        <p class="card-text" style="margin-bottom:0px;">

                                            @if($illustrators->sale_price == null || $illustrators->sale_price == "0.00")
                                            <b>₦{{ number_format($illustrators->regular_price, 2, ',', '.') }}</b>
                                            @else
                                            <strike>₦{{ number_format($illustrators->regular_price, 2, ',', '.') }}</strike>&nbsp;
                                            <b>₦{{ number_format($illustrators->sale_price, 2, ',', '.') }}</b>
                                            @endif



                                            {{-- ₦{{ number_format($illustrators->regular_price, 2, ',', '.') }} --}}
                                            
                                            <br><small> @foreach ($illustrators->categories as $category)
                                            {{ $category->name }}, 
                                        @endforeach</small></p>
                                        <footer class="blockquote-footer"><a href="{{route('illustrator.single', $illustrators->user_id)}}">{{$illustrators->user->shop_name}}</a> </footer>
   
                                        <a href="{{route('product.single', $illustrators->slug)}}" class="btn btn-primary btn-sm" style="text-decoration:none">View Product</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="row">
                            {{-- <div class="d-flex"><div class="mx-auto">{{$illustrators->links()}}</div></div> --}}
                        </div>
                    </div>
                </div>
        </main>
    @endsection
</x-home.index-master>
