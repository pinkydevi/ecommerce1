@extends('layouts.app')
@section('content')
@include('layouts.front_partial.collaps_nav')
<!-- START MAIN CONTENT -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                @if($products->isEmpty())
                    <p>No products found.</p>
                @else
                    @foreach($products as $product)
                        <div class="col-md-3 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($product->thumbnail) }}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$product->id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product.details',$product->slug) }}">{{ $product->name }}</a></h6>
                                    <div class="product_price">
                                    @if($product->discount_price==NULL)
                                            <span class="price">{{ $setting->currency }}{{ $product->selling_price }}</span>
                                            @else
                                            <span
                                                class="price">{{ $setting->currency }}{{ $product->discount_price }}</span>
                                            <del>{{ $setting->currency }}{{ $product->selling_price }}</del>

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
                                            @foreach(explode(',', $product->color) as $color)
                                                        <span data-color="{{ $color }}"></span>
                                                    @endforeach
                                        </div>
                                    </div>
                                    <div class="list_product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$product->id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div> <!-- Close shop_container row -->
            </div> <!-- Close col-lg-9 -->
        </div> <!-- Close row -->
    </div> <!-- Close container -->
</div> <!-- Close section -->
</div> <!-- Close main_content -->

<script src="{{ asset('front') }}/js/shop_custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //ajax request send for collect childcategory
     $(document).on('click', '.quick_view', function(){ 
      var id = $(this).attr("id");

      $.ajax({
           url: "{{ url("/product-quick-view/") }}/"+id,
           type: 'get',
           success: function(data) {
                $("#quick_view_body").html(data);
           }
        });
     });
</script>

@endsection