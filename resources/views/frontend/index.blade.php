@extends('layouts.app')
@section('content')
@include('layouts.front_partial.main_nav')
<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div id="carouselExampleControls" class="carousel slide light_arrow" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php $first = true; @endphp

                        @foreach($bannerproduct as $row)
                        <div class="carousel-item {{ $first ? 'active' : '' }} background_bg" data-img-src="{{ asset($row->thumbnail) }}">
                            <div class="banner_slide_content banner_content_inner">
                                <div class="col-lg-8 col-10">
                                    <div class="banner_content overflow-hidden">
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">Get up to 50% off Today Only!</h5>
                                        <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $row->name }}</h2>
                                        @if($row->discount_price==NULL)
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="1.5s">
                                            {{ $setting->currency }}{{ $row->selling_price }}</h5>
                                        @else
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="1.5s">
                                            <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span><del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        </h5>
                                        @endif
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="2s">
                                            {{ $row->brand->brand_name }}</h5>
                                        <a class="btn btn-fill-out btn-radius staggered-animation text-uppercase " href="{{ route('product.details',$row->slug) }}" data-animation="slideInLeft" data-animation-delay="2.5s">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $first = false; @endphp
                        @endforeach
                    </div>
                    <ol class="carousel-indicators indicators_style1">
                        <li data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExampleControls" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section small_pb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h2>Exclusive Products</h2>
                        </div>
                        <div class="tab-style2">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tabmenubar" aria-expanded="false">
                                <span class="ion-android-menu"></span>
                            </button>
                            <ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link active" id="arrival-tab" data-bs-toggle="tab" href="#arrival" role="tab" aria-controls="arrival" aria-selected="true">Featured</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="special-tab" data-bs-toggle="tab" href="#special" role="tab" aria-controls="special" aria-selected="false">Most Popular</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab_slider">
                        <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                            <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                                @foreach($featured as $row)
                                <div class="item">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="{{ route('product.details',$row->slug) }}">
                                                <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                    <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                                    <li><a href="{{ route('add.wishlist',$row->id) }}"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}</a>
                                            </h6>
                                            <div class="product_price">
                                                @if($row->discount_price==NULL)
                                                <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                                @else
                                                <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                                <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:68%"></div>
                                                </div>
                                                <span class="rating_num">(15)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                                                    blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch">
                                                    @foreach(explode(',', $row->color) as $color)
                                                    <span data-color="{{ $color }}"></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- most popular product  Panel -->
                        <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
                            <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                                @foreach($popular_product as $row)
                                <div class="item">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="{{ route('product.details',$row->slug) }}">
                                                <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                    <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                                    <li><a href="{{ route('add.wishlist',$row->id) }}"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}</a>
                                            </h6>
                                            <div class="product_price">
                                                @if($row->discount_price==NULL)
                                                <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                                @else
                                                <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                                <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:68%"></div>
                                                </div>
                                                <span class="rating_num">(15)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                                                    blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch">
                                                    @foreach(explode(',', $row->color) as $color)
                                                    <span data-color="{{ $color }}"></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION CATEGORIES -->
    <div class="section small_pb small_pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>Top Categories</h2>
                    </div>
                    <p class="text-center leads">Explore curated categories from electronics to fashion and home essentials. Elevate your lifestyle with quality finds. Dive in now!</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}, "991":{"items": "6"}, "1199":{"items": "7"}}'>
                        @foreach($category as $row)
                        <div class="item">
                            <div class="categories_box">
                                <a href="{{ route('categorywise.product',$row->id) }}">
                                    <img src="{{ asset($row->icon) }}" alt="{{ $row->category_name }}" />
                                    <span>{{ $row->category_name }}</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CATEGORIES -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt small_pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h2>Deal Of The Days</h2>
                        </div>
                        <div class="deal_timer">
                            <div class="countdown_time countdown_style1" data-time="2024/04/03 13:22:15"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                        @foreach($todaydeal as $row)
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$row->id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ $row->name }}</a></h6>
                                    <div class="product_price">
                                        @if($row->discount_price==NULL)
                                        <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                        @else
                                        <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                        <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        @endif
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(21)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit
                                            massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- Home Category SHOP -->

    @foreach($home_category as $row)
    @php
    $cat_product=DB::table('products')->where('category_id',$row->id)->orderBy('id','DESC')->limit(24)->get();
    @endphp
    <div class="section pb_20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>{{ $row->category_name }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        @foreach($cat_product as $row)
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ $row->name }}</a></h6>
                                    <div class="product_price">
                                        @if($row->discount_price==NULL)
                                        <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                        @else
                                        <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                        <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        @endif
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(21)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit
                                            massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            @foreach(explode(',', $row->color) as $color)
                                            <span data-color="{{ $color }}"></span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- END Home Category -->

    <!-- START SECTION campaign -->

    <div class="section pb_20 small_pt">
        <div class="container-fluid px-2">
            <div class="row g-0">
                @foreach($campaign as $row)
                <div class="col-md-4">
                    <div class="sale_banner">
                        <a class="hover_effect1" href="{{ route('frontend.campaign.product',$row->id) }}">
                            <img src="{{ asset($row->image) }}" alt="{{ $row->title }}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- END SECTION campaign -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt pb_20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h2>Trendy Product</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_slider product_list carousel_slider owl-carousel owl-theme nav_style3" data-loop="true" data-dots="true" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "767":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "3"}}'>
                        @foreach($trendy_product as $row)
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                    </a>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,20) }}</a>
                                    </h6>
                                    <div class="product_price">
                                        @if($row->discount_price==NULL)
                                        <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                        @else
                                        <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                        <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION CLIENT LOGO -->
    <div class="section small_pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h2>Our Brands</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="true" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}'>
                        @foreach($brand as $row)
                        <div class="item">
                            <div class="cl_logo">
                                <a href="{{ route('brandwise.product',$row->id) }}" title="{{ $row->brand_name }}"><img src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}" /></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CLIENT LOGO -->

<!-- START SECTION TESTIMONIAL -->
<div class="section bg_redon">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Our Client Say!</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2" data-nav="true" data-dots="true" data-center="true" data-loop="true" data-autoplay="true" data-items='1'>
                    @foreach($review as $row)
                    <div class="testimonial_box">
                        <div class="testimonial_desc">
                            <p>{{$row->review}}</p>
                        </div>
                        <div class="author_wrap">
                            <div class="author_img">
                            <img src="{{ asset($row->user_photo) }}" alt="user_img1" />
                            </div>
                            <div class="author_name">
                                <h6>{{ $row->name }}</h6>
                                <span>{{ $row->review_date }}</span>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        @if($row->rating == 5)
                                        <div class="product_rate" style="width:100%"></div>
                                        @elseif($row->rating == 4)
                                        <div class="product_rate" style="width:80%"></div>
                                        @elseif($row->rating == 3)
                                        <div class="product_rate" style="width:60%"></div>
                                        @elseif($row->rating == 2)
                                        <div class="product_rate" style="width:40%"></div>
                                        @else
                                        <div class="product_rate" style="width:20%"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION TESTIMONIAL -->

<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_dark small_pt small_pb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="newsletter_text text_white">
                    <h3>Join Our Newsletter Now</h3>
                    <p> Register now to get updates on promotions. </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form2 rounded_input">
                    <form action="{{ route('store.newsletter') }}" method="post">
                        @csrf
                        <input type="email" name="email" required="" class="form-control " placeholder="Enter Email Address">
                        <button type="submit" class="btn btn-fill-out btn-radius" name="submit" value="Submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->
</div>
<!-- END MAIN CONTENT -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="quick_view_body">

            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //ajax request send for collect childcategory
    $(document).ready(function() {
        //ajax request send for collect childcategory
        $(document).on('click', '.quick_view', function(e) {
            e.preventDefault();
            var id = $(this).attr("id");
            $.ajax({
                url: "{{ url('/product-quick-view/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $("#quick_view_body").html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

        //store coupon ajax call
        $('#newsletter_form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: request,
                success: function(data) {
                    toastr.success(data);
                    $('#newsletter_form')[0].reset();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
</script>
@endsection