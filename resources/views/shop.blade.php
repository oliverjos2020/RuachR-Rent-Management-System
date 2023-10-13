<x-home.index-master>
    @section('content')
       
            {{-- <div class="category-banner-container bg-gray">
                <div class="category-banner banner text-uppercase"
                    style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
                    <div class="container position-relative">
                        <div class="row">
                            <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                                <h3>Fashion<br>Deals</h3>
                                <a href="#" class="btn btn-dark">Get Yours!</a>
                            </div>
                            <div class="pl-lg-3 col-md-4 offset-md-0 offset-1 pt-3">
                                <div class="coupon-sale-content">
                                    <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">Exclusive COUPON
                                    </h4>
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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">Accessories</li> --}}
                    </ol>
                </nav>

                <div class="row" id="prod">
                    <div class="col-lg-9 main-content">
                        <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                            <div class="toolbox-left">
                                <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3"
                                        viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="15" x2="26" y1="9" y2="9" class="cls-1">
                                        </line>
                                        <line x1="6" x2="9" y1="9" y2="9" class="cls-1">
                                        </line>
                                        <line x1="23" x2="26" y1="16" y2="16" class="cls-1">
                                        </line>
                                        <line x1="6" x2="17" y1="16" y2="16" class="cls-1">
                                        </line>
                                        <line x1="17" x2="26" y1="23" y2="23" class="cls-1">
                                        </line>
                                        <line x1="6" x2="11" y1="23" y2="23" class="cls-1">
                                        </line>
                                        <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                        <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                        <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                        <path
                                            d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                    </svg>
                                    <span>Filter</span>
                                </a>

                                <div class="toolbox-item toolbox-sort">
                                    <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                                        <a href="#prod" class="text-dark">Sort By:</a>
                                        <div class="header-menu">
                                            <ul>
                                                <li><a href="?sort_by=price_asc&category={{ $category }}#prod">Price
                                                        (Low
                                                        to High)</a></li>
                                                <li><a href="?sort_by=price_desc&category={{ $category }}#prod">Price
                                                        (High to Low)</a></li>
                                                <li><a href="?sort_by=name_asc&category={{ $category }}#prod">Name (A to
                                                        Z)</a></li>
                                                <li><a href="?sort_by=name_desc&category={{ $category }}#prod">Name (Z
                                                        to
                                                        A)</a></li>
                                            </ul>
                                        </div>
                                        <!-- End .header-menu -->
                                    </div>

                                </div>
                                <!-- End .toolbox-item -->
                            </div>
                            <!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-show">

                                    {{ $product->appends(['sort_by' => $sortBy, 'per_page' => $perPage, 'category' => $category])->links() }}

                                </div>

                            </div>
                            <!-- End .toolbox-right -->
                        </nav>

                        <div class="row mb-4">

                            <!-- End .col-sm-4 -->
                            @forelse ($product as $products)
                                <div class="col-6 col-sm-4 col-md-3">
                                    <div class="product-default">
                                        <figure>
                                            <a href="{{ route('product.single', $products->slug) }}">
                                                <img src="{{ $products->featured_image }}" width="280" height="280"
                                                    alt="product" />
                                                <img src="{{ $products->featured_image }}" width="280" height="280"
                                                    alt="product" />
                                            </a>
                                            <div class="label-group">
                                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                                @if ($products->sale_price == null || $products->sale_price == '0.00')
                                                @else
                                                    <div class="product-label label-hot">On Sale</div>
                                                @endif

                                            </div>
                                        </figure>

                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    {{-- <a href="#" class="product-category">{{$category->name}}</a> --}}
                                                    @foreach ($products->categories as $category)
                                                        {{ $category->name }},
                                                    @endforeach
                                                </div>
                                            </div>

                                            <h3 class="product-title"> <a
                                                    href="{{ route('product.single', $products->slug) }}">{{ $products->title }}</a>
                                            </h3>

                                            {{-- <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div> --}}
                                            <!-- End .product-container -->

                                            <div class="price-box d-flex">
                                                @if ($products->sale_price == null || $products->sale_price == '0.00')
                                                    <span
                                                        class="product-price">₦{{ number_format($products->regular_price, 2, ',', '.') }}</span>
                                                @else
                                                    <strike>₦{{ number_format($products->regular_price, 2, ',', '.') }}</strike>&nbsp;
                                                    <span
                                                        class="product-price">₦{{ number_format($products->sale_price, 2, ',', '.') }}</span>
                                                @endif
                                            </div>
                                            <!-- End .price-box -->

                                            <div class="product-action">

                                                <a href="{{ route('product.single', $products->slug) }}"
                                                    class="btn-icon btn-add-cart"><i
                                                        class="fa fa-arrow-right"></i><span>VIEW PRODUCT</span></a>
                                                <!-- <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
                                            </div>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center">No products available at the moment</div>
                                </div>
                            @endforelse
                            <!-- End .col-sm-4 -->

                            <!-- End .col-sm-4 -->
                        </div>
                        <!-- End .row -->

                        {{-- <nav class="toolbox toolbox-pagination mb-4">
                            <div class="toolbox-item toolbox-show">

                                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                                    <a href="#prod" class="text-dark">Sort By:</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="?sort_by=price_asc&category={{$category}}#prod">Price (Low to
                                                    High)</a></li>
                                            <li><a href="?sort_by=price_desc&category={{$category}}#prod">Price (High to
                                                    Low)</a></li>
                                            <li><a href="?sort_by=name_asc&category={{$category}}#prod">Name (A to
                                                    Z)</a></li>
                                            <li><a href="?sort_by=name_desc&category={{$category}}#prod">Name (Z to
                                                    A)</a></li>
                                        </ul>
                                    </div>
                            
                                </div>
                                
                            </div> --}}



                        {{-- {{ $product->appends(['sort_by' => $sortBy, 'per_page' => $perPage, 'category' => $category])->links() }} --}}


                        {{-- </nav> --}}
                    </div>
                    <!-- End .col-lg-9 -->

                    <div class="sidebar-overlay"></div>
                    <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                        <div class="sidebar-wrapper">
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                        aria-controls="widget-body-2">Categories</a>
                                </h3>

                                <div class="collapse show" id="widget-body-2">
                                    <div class="widget-body">
                                        <ul class="cat-list">

                                            @foreach ($cat as $categories)
                                                <li>
                                                    <a href="?category={{ $categories->id }}"
                                                        style="margin-bottom: 15px;">{{ $categories->name }}</a>
                                                </li>
                                                <hr style="margin-top: 5px; margin-bottom: 10px;">
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>


                            <!-- End .widget -->

                            <div class="widget widget-featured">
                                <h3 class="widget-title">Featured</h3>

                                <div class="widget-body">
                                    <div class="owl-carousel widget-featured-products">
                                        <div class="featured-col">
                                            @forelse ($featuredProducts as $featuredProduct)
                                                <div class="product-default left-details product-widget">
                                                    <figure>
                                                        <a href="{{ route('product.single', $featuredProduct->slug) }}">
                                                            <img src="{{ $featuredProduct->featured_image }}"
                                                                width="74" height="74" alt="product">
                                                            <img src="{{ $featuredProduct->featured_image }}"
                                                                width="74" height="74" alt="product">
                                                        </a>
                                                    </figure>

                                                    <div class="product-details">
                                                        <h3 class="product-title"> <a
                                                                href="{{ route('product.single', $featuredProduct->slug) }}">{{$featuredProduct->title}}</a>
                                                        </h3>

                                                        {{-- <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div> --}}
                                                        <!-- End .product-container -->

                                                        <div class="price-box">
                                                            <span
                                                                class="product-price">₦{{ number_format($featuredProduct->regular_price, 2, ',', '.') }}</span>
                                                        </div>
                                                        <!-- End .price-box -->
                                                    </div>
                                                    <!-- End .product-details -->
                                                </div>
                                            @empty
                                                <div class="alert alert-info text-center">No products available at the
                                                    moment</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- End .featured-col -->


                                    <!-- End .featured-col -->
                                </div>
                                <!-- End .widget-featured-slider -->
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->

                        <!-- <div class="widget widget-block">
                                    <h3 class="widget-title">Custom HTML Block</h3>
                                    <h5>This is a custom sub-title.</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam
                                        non tellus </p>
                                </div> -->
                        <!-- End .widget -->
                </div>
                <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
            </div>
            <!-- End .container -->


    @endsection
</x-home.index-master>
