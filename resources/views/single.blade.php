<x-home.index-master>
    @section('content')
        <style>
            .chat-message {
                padding: 10px;
                border-radius: 10px;
                margin-bottom: 10px;
                font-size: 16px;
            }

            .buyer-message {
                background-color: #DCF8C6;
                color: #000;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: right;
                /* Align buyer messages to the right */
            }

            .seller-message {
                background-color: #EAEAEA;
                color: #000;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: left;
                /* Align seller messages to the left */
            }
        </style>
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="/shop">Products</a></li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                @if (session()->has('add-wishlist'))
                    <div class="cart-message">
                        <strong class="single-cart-notice">“{{ $product->title }}”</strong>
                        <span>has been added to your wishlist.</span>
                    </div>
                @endif
                @if (session()->has('cart-added'))
                    <div class="alert alert-success">“{{ session('cart-added') }}” <span> has been added to your
                            cart.</span></div>
                @endif

                <div class="row">
                    @if ($product->user->roles->first()->name !== 'Illustrator')
                        <div class="col-lg-4 col-md-6 product-single-gallery">
                            <div class="product-slider-container">

                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ $product->featured_image }}"
                                            data-zoom-image="{{ $product->featured_image }}" width="468" height="468"
                                            alt="product" />
                                    </div>
                                    @foreach ($photo as $photos)
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ $photos->file }}"
                                                data-zoom-image="{{ $photos->file }}" width="468" height="468"
                                                alt="product" />
                                        </div>
                                    @endforeach

                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="{{ $product->featured_image }}" width="110" height="110"
                                        alt="product-thumbnail" />
                                </div>
                                @forelse($photo as $photos)
                                    <div class="owl-dot">
                                        <img src="{{ $photos->file }}" width="110" height="110"
                                            alt="product-thumbnail" />
                                    </div>
                                @empty
                                    <div class="alert alert-info">No More Product preview available</div>
                                @endforelse

                            </div>
                        </div>
                        <!-- End .product-single-gallery -->

                        <div class="col-lg-7 col-md-6 product-single-details">
                            <h3 class="product-title">{{ $product->title }} </h3>

                            <div class="product-nav">

                            </div>

                            <div class="ratings-container">

                            </div>
                            <!-- End .ratings-container -->

                            <hr class="short-divider">

                            <div class="price-box">
                                @if ($product->sale_price == null || $product->sale_price == '0.00')
                                    <!-- <span class="old-price">${{ number_format($product->sale_price, 2, ',', ',') }}</span> -->
                                    <span
                                        class="new-price">₦{{ number_format($product->regular_price, 2, ',', ',') }}</span>
                                @else
                                    <span class="new-price">₦{{ number_format($product->sale_price, 2, ',', ',') }}</span>
                                    <span
                                        class="old-price">₦{{ number_format($product->regular_price, 2, ',', ',') }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->

                            <div class="product-desc">
                                <p>
                                    {{ $product->short_description }}
                                </p>
                            </div>
                            <!-- End .product-desc -->

                            <ul class="single-info-list">

                                <li>

                                    <div
                                        class="badge badge-{{ $product->quantity < 1 ? 'danger' : 'success' }} py-2 px-2">
                                        {{ $product->quantity < 1 ? 'Out of Stuck' : 'Instock' }}</div>
                                </li>

                                <li>
                                    UNITS: <strong class="text-success">{{ $product->quantity }} Units Left</strong>
                                </li>
                                <li>
                                    SKU: <strong>{{ $product->SKU }}</strong>
                                </li>

                                <li>
                                    CATEGORY: <strong>
                                        @foreach ($product->categories as $category)
                                            <a href="#" class="product-category">{{ $category->name }}, </a>
                                        @endforeach
                                    </strong>
                                </li>

                                <!-- <li>
                                            TAGs: <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                                            <strong><a href="#" class="product-category">SWEATER</a></strong>
                                        </li> -->
                            </ul>
                            <form method="POST" action="{{ route('cart.create') }}" style="margin-bottom:0px !important">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                <input type="hidden" name="product_name" value="{{ $product->title }}"
                                    class="form-control">

                                <div class="product-action">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="text" name="qty">
                                        @if ($product->sale_price == null || $product->sale_price == '0.00')
                                            <input type="hidden" name="price" value="{{ $product->regular_price }}"
                                                class="form-control">
                                        @else
                                            <input type="hidden" name="price" value="{{ $product->sale_price }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <!-- End .product-single-qty -->
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-dark btn-sm mr-2" title="Add to Cart">Add to
                                            Cart</button>
                                    @else
                                        <a href="/login" class="btn btn-dark mr-2" title="Add to Cart">Add to
                                            Cart</a>
                                    @endif

                                    <!-- <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a> -->
                                </div>
                            </form>
                            <!-- End .product-action -->

                            <hr class="divider mb-0 mt-0">

                            <div class="product-single-share mb-3">
                                <label class="sr-only">Share:</label>

                                <div class="social-icons mr-2">
                                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                        title="Facebook"></a>
                                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                        title="Twitter"></a>
                                    <a href="#" class="social-icon social-linkedin fab fa-linkedin-in"
                                        target="_blank" title="Linkedin"></a>
                                    <a href="#" class="social-icon social-gplus fab fa-google-plus-g"
                                        target="_blank" title="Google +"></a>
                                    <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                        title="Mail"></a>
                                </div>
                                <!-- End .social-icons -->


                                <a href="{{ $isWishlist ? '#' : route('add.wishlist', $product->id) }}"
                                    class="btn btn-dark btn-sm">
                                    <i class="icon-wishlist-2"></i>
                                    <span>{{ $isWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                                </a>

                            </div>
                            <!-- End .product single-share -->
                        </div>
                    @else
                        <div class="col-lg-4 col-md-4 product-single-gallery">
                            <div class="product-slider-container">

                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ $product->featured_image }}"
                                            data-zoom-image="{{ $product->featured_image }}" width="468"
                                            height="468" alt="product" />
                                    </div>
                                    @foreach ($photo as $photos)
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ $photos->file }}"
                                                data-zoom-image="{{ $photos->file }}" width="468" height="468"
                                                alt="product" />
                                        </div>
                                    @endforeach

                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="{{ $product->featured_image }}" width="110" height="110"
                                        alt="product-thumbnail" />
                                </div>
                                @forelse($photo as $photos)
                                    <div class="owl-dot">
                                        <img src="{{ $photos->file }}" width="110" height="110"
                                            alt="product-thumbnail" />
                                    </div>
                                @empty
                                    <div class="alert alert-info">No More Product preview available</div>
                                @endforelse

                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 product-single-details">
                            <h3 class="product-title">{{ $product->title }} </h3>

                            <div class="product-nav">

                            </div>

                            <div class="ratings-container">

                            </div>
                            <!-- End .ratings-container -->

                            <hr class="short-divider">

                            <div class="price-box">
                                @if ($product->sale_price == null || $product->sale_price == '0.00')
                                    <!-- <span class="old-price">${{ number_format($product->sale_price, 2, ',', ',') }}</span> -->
                                    <span
                                        class="new-price">₦{{ number_format($product->regular_price, 2, ',', ',') }}</span>
                                @else
                                    <span class="new-price">₦{{ number_format($product->sale_price, 2, ',', ',') }}</span>
                                    <span
                                        class="old-price">₦{{ number_format($product->regular_price, 2, ',', ',') }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->

                            <div class="product-desc">
                                <p>
                                    {{ $product->short_description }}
                                </p>
                            </div>
                            <!-- End .product-desc -->

                            <ul class="single-info-list">
                                <li>

                                    <div
                                        class="badge badge-{{ $product->quantity < 1 ? 'danger' : 'success' }} py-2 px-2">
                                        {{ $product->quantity < 1 ? 'Out of Stuck' : 'Instock' }}</div>
                                </li>

                                <li>
                                    UNITS: <strong class="text-success">{{ $product->quantity }} Units Left</strong>
                                </li>
                                <li>
                                    SHOP: <strong><a
                                            href="{{ route('illustrator.single', $product->user_id) }}">{{ $product->user->shop_name }}</a></strong>
                                </li>
                                <li>
                                    SKU: <strong>{{ $product->SKU }}</strong>
                                </li>

                                <li>
                                    CATEGORY: <strong>
                                        @foreach ($product->categories as $category)
                                            <a href="#" class="product-category">{{ $category->name }}, </a>
                                        @endforeach
                                    </strong>
                                </li>

                                <!-- <li>
                                                TAGs: <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                                                <strong><a href="#" class="product-category">SWEATER</a></strong>
                                            </li> -->
                            </ul>
                            <form method="POST" action="{{ route('cart.create') }}"
                                style="margin-bottom:0px !important">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}"
                                    class="form-control">
                                <input type="hidden" name="product_name" value="{{ $product->title }}"
                                    class="form-control">

                                <div class="product-action">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="text" name="qty">
                                        @if ($product->sale_price == null || $product->sale_price == '0.00')
                                            <input type="hidden" name="price" value="{{ $product->regular_price }}"
                                                class="form-control">
                                        @else
                                            <input type="hidden" name="price" value="{{ $product->sale_price }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <!-- End .product-single-qty -->
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-dark btn-sm mr-2"
                                            {{ $product->quantity < 1 ? 'disabled' : '' }} title="Add to Cart">Add
                                            to Cart </button>
                                    @else
                                        <a href="/login" class="btn btn-dark mr-2" title="Add to Cart">Add to
                                            Cart</a>
                                    @endif

                                    <!-- <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a> -->
                                </div>
                            </form>
                            <!-- End .product-action -->

                            <hr class="divider mb-0 mt-0">

                            <div class="product-single-share mb-3">
                                <label class="sr-only">Share:</label>

                                {{-- <div class="social-icons mr-2">
                                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                        title="Facebook"></a>
                                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                        title="Twitter"></a>
                                    <a href="#" class="social-icon social-linkedin fab fa-linkedin-in"
                                        target="_blank" title="Linkedin"></a>
                                    <a href="#" class="social-icon social-gplus fab fa-google-plus-g"
                                        target="_blank" title="Google +"></a>
                                    <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                        title="Mail"></a>
                                </div> --}}
                                <!-- End .social-icons -->


                                <a href="{{ $isWishlist ? '#' : route('add.wishlist', $product->id) }}"
                                    class="btn btn-dark btn-sm">
                                    <i class="icon-wishlist-2"></i>
                                    <span>{{ $isWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                                </a>

                            </div>
                            <!-- End .product single-share -->
                        </div>
                        <div class="col-lg-3 col-md-3 product-illustrator">
                            <div class="card" style="width: x18rem;">

                                <img src="{{ $product->user->banner == '/images/' ? $product->user->banner . 'main-logo.png' : $product->user->banner }}"
                                    class="card-img-top" alt="...">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->user->shop_name }}</h5>
                                    <ul>

                                        <li>Products: {{ $product->user->products()->count() }}
                                        </li>
                                        <li>Joined: {{ $product->user->created_at->diffForHumans() }}</li>
                                        <li></li>
                                        <li><a href="{{ route('illustrator.single', $product->user_id) }}"
                                                style="text-decoration:none;" class="btn btn-outline-dark btn-sm mt-1">
                                                VISIT STORE &rarr;</a></li>
                                    </ul>

                                </div>

                            </div>

                            <div class="container">
                                @if (Auth::check())
                                    <a href="#" style="width: 100%;" class="btn btn-outline-dark btn-sm mt-0"
                                        data-toggle="modal" data-target="#chatModal">CHAT WITH ILLUSTRATOR</a>
                                @endif
                                <div class="modal fade" id="chatModal" tabindex="-1" role="dialog"
                                    aria-labelledby="chatModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="chatModalLabel">Chat with Seller</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="chat-body">
                                                <div class="chat-container">
                                                    <div class="chat-messages">
                                                        <!-- Example chat messages -->
                                                        {{-- <div class="message received">
                                                            <p>Hello, how can I help you?</p>
                                                            <span class="timestamp">12:30 PM</span>
                                                        </div>
                                                        <div class="message sent">
                                                            <p>I have a question about the product.</p>
                                                            <span class="timestamp">12:32 PM</span>
                                                        </div> --}}
                                                        <!-- Add more chat messages here -->
                                                    </div>
                                                    <div class="chat-input">
                                                        <div id="chatMessages"></div>
                                                        {{-- <button id="fetchMessages">Fetch Messages</button> --}}
                                                        <!-- Example chat input form -->

                                                    </div>
                                                </div>
                                            </div>
                                            @if (Auth::check())
                                                <form id="chatForm" method="POST" action="{{ route('chat.store') }}">
                                                    <div class="modal-footer">

                                                        @csrf
                                                        <input type="text" name="message" autocomplete="off"
                                                            class="form-control" placeholder="Describe your design...">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="buyer_id"
                                                            value="{{ Auth()->user()->id }}">
                                                        <input type="hidden" name="seller_id"
                                                            value="{{ $product->user->id }}">
                                                        <input type="hidden" name="sender_type" value="buyer">
                                                        <button type="submit" id="sendMessage"
                                                            class="btn btn-primary mt-0 mb-1">Send</button>

                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                            role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                        aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            {{ $product->short_description }}
                        </div>
                        <!-- End .product-desc-content -->
                    </div>

                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                        aria-labelledby="product-tab-reviews">
                        <div class="product-reviews-content">
                            <h5 class="reviews-titlex">Review for {{ $product->title }}</h3>

                                <div class="comment-list">
                                    @forelse($product->reviews as $review)
                                        <div class="comments">


                                            <figure class="img-thumbnail">
                                                <img src="/images/user.png" alt="author" width="80"
                                                    height="80">
                                            </figure>

                                            <div class="comment-block mt-2">
                                                <div class="comment-header">
                                                    <div class="comment-arrow"></div>

                                                    <span class="comment-by">
                                                        <strong>{{ $review->user->name }}</strong> –
                                                        {{ $review->created_at->diffForHumans() }}
                                                    </span>
                                                </div>

                                                <div class="comment-content">
                                                    <p>{{ $review->message }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    @empty
                                        <div class="alert alert-info">No review available</div>
                                    @endforelse
                                </div>

                                <div class="divider"></div>


                                <!-- End .add-product-review -->
                        </div>
                        <!-- End .product-reviews-content -->
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .product-single-tabs -->

            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @forelse ($relatedProducts as $relatedProduct)
                        <div class="product-default">
                            <figure>
                                <a href="{{ route('product.single', $relatedProduct->slug) }}">
                                    <img src="{{ $relatedProduct->featured_image }}" width="280" height="280"
                                        alt="product">
                                    <img src="{{ $relatedProduct->featured_image }}" width="280" height="280"
                                        alt="product">
                                </a>
                                <!-- <div class="label-group">
                                            <div class="product-label label-hot">HOT</div>
                                            <div class="product-label label-sale">-20%</div>
                                        </div> -->
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    {{-- <a href="category.html" class="product-category">{{$relatedProduct->category->name}}</a> --}}
                                    @foreach ($relatedProduct->categories as $category)
                                        <a href="#" class="product-category">{{ $category->name }}, </a>
                                    @endforeach

                                </div>
                                <h3 class="product-title">
                                    <a
                                        href="{{ route('product.single', $relatedProduct->slug) }}">{{ $relatedProduct->title }}</a>
                                </h3>
                                <div class="ratings-container">
                                    <!-- <div class="product-ratings">
                                                <span class="ratings" style="width:80%"></span>
                                                
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div> -->
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->
                                <div class="price-box">
                                    <del
                                        class="old-price">₦{{ number_format($relatedProduct->sale_price, 2, ',', '.') }}</del>
                                    <span
                                        class="product-price">₦{{ number_format($relatedProduct->regular_price, 2, ',', ',') }}</span>
                                </div>
                                <!-- End .price-box -->
                                <div class="product-action">
                                    <!-- <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                                    class="icon-heart"></i></a> -->
                                    <a href="{{ route('product.single', $relatedProduct->slug) }}"
                                        class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>VIEW PRODUCT
                                        </span></a>

                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @empty
                        <div class="alert alert-info text-center">No products available at the moment</div>
                    @endforelse
                </div>
                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->

            <hr class="mt-0 m-b-5" />

            <div class="product-widgets-container row pb-2">
                <div class="col-lg-6 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Featured Products</h4>
                    @forelse ($featuredProducts as $featuredProduct)
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ route('product.single', $featuredProduct->slug) }}">
                                    <img src="{{ $featuredProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                    <img src="{{ $featuredProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> <a
                                        href="{{ route('product.single', $featuredProduct->slug) }}">{{ $featuredProduct->title }}</a>
                                </h3>

                                <div class="ratings-container">
                                    <!-- <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
                                                
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div> -->
                                    <!-- End .product-ratings -->
                                </div>
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
                        <div class="alert alert-info text-center">No products available at the moment</div>
                    @endforelse
                </div>

                <div class="col-lg-6 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Latest Products</h4>
                    @forelse ($recentProducts as $recentProduct)
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ route('product.single', $recentProduct->slug) }}">
                                    <img src="{{ $recentProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                    <img src="{{ $recentProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> <a
                                        href="{{ route('product.single', $recentProduct->slug) }}">{{ $recentProduct->title }}</a>
                                </h3>

                                <div class="ratings-container">
                                    <!-- <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
                                                
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div> -->
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span
                                        class="product-price">₦{{ number_format($recentProduct->regular_price, 2, ',', '.') }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @empty
                        <div class="alert alert-info text-center">No products available at the moment</div>
                    @endforelse

                </div>

                {{-- <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Top Rated Products</h4>
                    @forelse ($recentProducts as $recentProduct)
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ route('product.single', $recentProduct->slug) }}">
                                    <img src="{{ $recentProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                    <img src="{{ $recentProduct->featured_image }}" width="74" height="74"
                                        alt="product">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> <a
                                        href="{{ route('product.single', $recentProduct->slug) }}">{{ $recentProduct->title }}</a>
                                </h3>

                                <div class="ratings-container">
                                    <!-- <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                         
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div> -->
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span
                                        class="product-price">₦{{ number_format($recentProduct->regular_price, 2, ',', '.') }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @empty
                        <div class="alert alert-info text-center">No products available at the moment</div>
                    @endforelse

                </div> --}}
            </div>
            <!-- End .row -->
        </div>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        @if (Auth::check())
            <script>
                $(document).ready(function() {

                    function getMessage() {

                        var product_id = {{ $product->id }};
                        var buyer_id = {{ Auth()->user()->id }};
                        var seller_id = {{ $product->user->id }};

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('chat.fetch') }}',
                            data: {
                                product_id: product_id,
                                buyer_id: buyer_id,
                                seller_id: seller_id,
                                sender_type: 'buyer', // Specify the sender type as 'buyer'
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(response) {
                                // Handle the successful response
                                console.log(response);

                                var messages = response.messages;
                                var chatMessages = $('#chatMessages');
                                var chatBody = $('#chat-body');
                                var scrollHeight = chatBody.prop(
                                    'scrollHeight'); // Get the current scroll height
                                chatMessages.empty();

                                // Compare new messages with existing messages and display only the new ones
                                for (var i = 0; i < messages.length; i++) {
                                    var message = messages[i];
                                    var chatMessage = $('<div></div>').text(message.message);

                                    if (message.sender_type === 'buyer') {
                                        chatMessage.addClass('buyer-message');
                                    } else if (message.sender_type === 'seller') {
                                        chatMessage.addClass('seller-message');
                                    }

                                    chatMessages.append(chatMessage);
                                }

                                var newScrollHeight = chatBody.prop(
                                    'scrollHeight'); // Get the new scroll height after appending new messages

                                // Scroll to the bottom if new messages were added
                                if (newScrollHeight > scrollHeight) {
                                    chatBody.scrollTop(newScrollHeight);
                                }
                            },
                            error: function(error) {
                                // Handle the error response
                                console.log(error);
                            }
                        });


                    }



                    setInterval(getMessage, 5000);



                    $('#chatForm').submit(function(event) {
                        event.preventDefault();

                        var form = $(this);
                        var url = form.attr('action');
                        var data = form.serialize();

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                getMessage();
                                // Handle the successful response
                                console.log(response);


                                // Reset the form or perform any other necessary actions
                                form.trigger('reset');
                            },
                            error: function(error) {
                                // Handle the error response
                                console.log(error);
                            }
                        });
                    });
                });
            </script>
        @endif
    @endsection
</x-home.index-master>
