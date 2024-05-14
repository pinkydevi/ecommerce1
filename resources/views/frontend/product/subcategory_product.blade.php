@extends('layouts.app')
@section('content')
@include('layouts.front_partial.collaps_nav')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ $subcategory->subcategory_name }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">category</a></li>
                    <li class="breadcrumb-item active">{{ $subcategory->subcategory_name }}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

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
                    <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}'>
                        @foreach($brand as $row)
                        <div class="item">
                            <div class="cl_logo">
                                <a href="{{ route('brandwise.product',$row->id) }}" title="{{ $row->brand_name }}"><img src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}cl_logo" /></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CLIENT LOGO -->

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="order">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:;" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                        <a href="javascript:;" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="">Showing</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row shop_container">
                        @php
                        $serial = $products->firstItem(); // Get the first item number
                        @endphp
                        @foreach($products as $row)
                        <div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($row->thumbnail) }}" alt="product_img1">
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            @foreach(explode(',', $row->color) as $color)
                                            <span data-color="{{ $color }}"></span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="list_product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$row->id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination mt-3 justify-content-center pagination_style1">
                                {{ $products->links() }} <!-- Display pagination links -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget_title">Categories</h5>
                            <ul class="widget_categories">
                                @foreach($childcategories as $row)
                                <li><a href="{{ route('childcategorywise.product',$row->id) }}"><span class="categories_name">{{$row->childcategory_name }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Filter</h5>
                            <div class="filter_price">
                                <div id="price_filter" data-min="0" data-max="500" data-min-value="50" data-max-value="300" data-price-sign="$"></div>
                                <div class="price_range">
                                    <span>Price: <span id="flt_price"></span></span>
                                    <input type="hidden" id="price_first">
                                    <input type="hidden" id="price_second">
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Brand</h5>
                            <ul class="list_brand">
                                @foreach($brand as $row)
                                <li>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="Arrivals" value="">
                                        <label class="form-check-label" for="Arrivals"><a href="{{ route('brandwise.product',$row->id) }}"><span>{{ $row->brand_name }}</span></a></label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Size</h5>
                            <div class="product_size_switch">
                                <span>xs</span>
                                <span>s</span>
                                <span>m</span>
                                <span>l</span>
                                <span>xl</span>
                                <span>2xl</span>
                                <span>3xl</span>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Color</h5>
                            <div class="product_color_switch">
                                <span data-color="#87554B"></span>
                                <span data-color="#333333"></span>
                                <span data-color="#DA323F"></span>
                                <span data-color="#2F366C"></span>
                                <span data-color="#B5B6BB"></span>
                                <span data-color="#B9C2DF"></span>
                                <span data-color="#5FB7D4"></span>
                                <span data-color="#2F366C"></span>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="shop_banner">
                                <div class="banner_img overlay_bg_20">
                                    <img src="assets/images/sidebar_banner_img.jpg" alt="sidebar_banner_img">
                                </div>
                                <div class="shop_bn_content2 text_white">
                                    <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                                    <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                    <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- END SECTION CLIENT LOGO -->
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

</div>
<!-- END MAIN CONTENT -->

<!-- START SECTION SHOP -->
<div class="section small_pt pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s3 text-center">
                    <h2>Trending items</h2>
                </div>
                <div class="small_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style4" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    @foreach($random_product as $row)
                    <div class="item">
                        <div class="product_box text-center">
                            <div class="product_img">
                                <a href="shop-product-detail.html">
                                    <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                        <li><a href="#" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                        <li><a href="{{ route('add.wishlist',$row->id) }}"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name,0,30) }}...</a></h6>
                                @if($row->discount_price==NULL)
                                <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                @else
                                <span class="price">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                <span class="price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                @endif
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:80%"></div>
                                    </div>
                                    <span class="rating_num">(21)</span>
                                </div>
                                <div class="pr_desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn btn-fill-out btn-radius quick_view" d="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a>
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
</div>
<!-- END SECTION SHOP -->
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
<script src="{{ asset('front') }}/js/shop_custom.js"></script>
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

</script>
@endsection