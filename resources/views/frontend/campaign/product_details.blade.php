@extends('layouts.app')
@section('content')
@include('layouts.front_partial.collaps_nav')
@php
$sum_rating=App\Models\Review::where('product_id',$product->id)->sum('rating');
$count_rating=App\Models\Review::where('product_id',$product->id)->count('rating');
@endphp

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Product Detail Right Sidebar</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Product Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                                <div class="product-image">
                                    <div class="product_img_box">
                                        <img id="product_img" src="{{ asset($product->thumbnail) }}" data-zoom-image="{{ asset($product->thumbnail) }}" alt="product_img1" />
                                        <a href="#" class="product_img_zoom" title="Zoom">
                                            <span class="linearicons-zoom-in"></span>
                                        </a>
                                    </div>
                                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                                        <div class="item">
                                            <a href="#" class="product_gallery_item active" data-image="{{ asset($product->thumbnail) }}" data-zoom-image="{{ asset($product->thumbnail) }}">
                                                <img src="{{ asset($product->thumbnail) }}" alt="product_small_img1" />
                                            </a>
                                        </div>
                                        @php
                                        $images=json_decode($product->images,true);
                                        $color=explode(',',$product->color);
                                        $sizes=explode(',',$product->size);
                                        @endphp
                                        @isset($images)
                                        @foreach($images as $key => $image)
                                        <div class="item">
                                            <a href="#" class="product_gallery_item" data-image="{{ asset('files/product/' . $image) }}" data-zoom-image="{{ asset('files/product/' . $image) }}">
                                                <img src="{{ asset('files/product/' . $image) }}" alt="product_small_img2" />
                                            </a>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>
                                </div>
                                @isset($product->video)
                                <div>
                                    <strong>Product Video:</strong>
                                    <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                @endisset
                            </div>
                            <input type="hidden" name="id" value="{{$product->id}}">
                            @if($product->discount_price==NULL)
                            <input type="hidden" name="price" value="{{$product->selling_price}}">
                            @else
                            <input type="hidden" name="price" value="{{$product->discount_price}}">
                            @endif

                            <div class="col-lg-6 col-md-6">
                                <div class="pr_detail">
                                    <div class="product_description">
                                        <h4 class="product_title"><a href="#">{{ $product->name }}</a></h4>
                                        <div class="product_price">
                                            <span class="price">{{ $setting->currency }}{{$product_price->price}}</span>

                                        </div>
                                        <div class="rating_wrap">
                                            @if($sum_rating !=NULL)
                                            @if(intval($sum_rating/$count_rating) == 5)
                                            <div class="rating">
                                                <div class="product_rate" style="width:100%"></div>
                                            </div>
                                            @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5)
                                            <$count_rating) <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5)
                                        <$count_rating) <div class="rating">
                                            <div class="product_rate" style="width:60%"></div>
                                    </div>
                                    @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5)
                                    <$count_rating) <div class="rating">
                                        <div class="product_rate" style="width:40%"></div>
                                </div>
                                @else
                                <div class="rating">
                                    <div class="product_rate" style="width:20%"></div>
                                </div>
                                @endif
                                @endif
                            </div>
                            <div class="pr_desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa
                                    enim.
                                    Nullam id varius nunc id varius nunc.</p>
                            </div>
                            <div class="product_sort_info">
                                <ul>
                                    <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty</li>
                                    <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                                    <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                                </ul>
                            </div>
                            @isset($product->color)
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">Color :</span>
                                <div class="product_color_switch">
                                    @foreach($color as $row)
                                    <span data-color="{{ $row }}"></span>
                                    @endforeach

                                </div>
                            </div>
                            @endisset
                            @isset($product->size)
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">Size :</span>
                                <div class="product_size_switch">
                                    @foreach($sizes as $size)
                                    <span value="{{ $size }}">{{ $size }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endisset
                        </div>
                        <hr />
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input id="quantity_input" type="text" name="qty" value="1" title="Qty" class="qty" size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <div class="cart_btn">
                                @if($product->stock_quantity< 1) <button class="btn btn-outline-danger" disabled="">
                                    Stock Out</button>
                                    @else
                                    <button class="btn btn-fill-out btn-addtocart" type="submit"> <i class="icon-basket-loaded"></i> <span class="loading d-none">....</span> Add
                                        to cart</button>
                                    @endif
                                    <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                                    <a class="add_wishlist" href="{{ route('add.wishlist',$product->id) }}"><i class="icon-heart"></i></a>
                            </div>
                        </div>

                        <hr />
                        <ul class="product-meta">
                            <li>Category: <a href="#">{{ $product->category->category_name }}
                                </a>>{{ $product->subcategory->subcategory_name }}</li>
                            <li>Brand: <a href="#">{{ $product->brand->brand_name }}</a></li>
                            <li>Stock: <a href="#">{{ $product->stock_quantity }}</a></li>
                            <li>Unit: {{ $product->unit }}</li>
                        </ul>

                        <div class="product_share">
                            <span>Share:</span>
                            <ul class="social_icons">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://jorenvanhocht.be"><span class="fa fa-facebook-official"></span></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://jorenvanhocht.be&amp;title=my share text&amp;summary=dit is de linkedin summary"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="https://wa.me/?text=http://jorenvanhocht.be"><span class="fa fa-whatsapp"></span></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                    <div class="tab-content shop_info_tab">
                        <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus
                                bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to
                                popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                                classical Latin literature from 45 BC, making it over 2000 years old.</p>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt
                                mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                expedita distinctio.</p>
                        </div>

                        <div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Product Name</td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Product Color</td>
                                    <td>{{ $product->color }}</td>
                                </tr>
                                <tr>
                                    <td>Product Brand</td>
                                    <td>{{ $product->brand->brand_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                            <div class="comments">
                                <h5 class="product_tab_title">2 Review For <span>Blue Dress For Woman</span></h5>
                                <ul class="list_none comment_list mt-4">
                                    @foreach($review as $row)
                                    <li>
                                        <div class="comment_img">
                                            <img src="{{asset('front')}}/images/user1.jpg" alt="user1" />
                                        </div>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="card-body">
                                                    @if($row->rating==5)
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:100%"></div>
                                                        </div>
                                                    </div>
                                                    @elseif($row->rating==4)
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:80%"></div>
                                                        </div>
                                                    </div>
                                                    @elseif($row->rating==3)
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:60%"></div>
                                                        </div>
                                                    </div>
                                                    @elseif($row->rating==2)
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:40%"></div>
                                                        </div>
                                                    </div>
                                                    @elseif($row->rating==1)
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:20%"></div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">{{ $row->user->name }}</span>
                                                <span class="comment-date">{{ date('d F , Y'), strtotime($row->review_date) }}</span>
                                            </p>
                                            <div class="description">
                                                <p>{{ $row->review }}</p>
                                            </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="review_form field_form">
                                <h5>Add a review</h5>

                                <form class="row mt-3" action="{{ route('store.review') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="form-group ">
                                        <label for="review">Write Your Review</label>
                                        <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
                                            <option disabled="" selected="">Select Your Review</option>
                                            <option value="1">1 star</option>
                                            <option value="2">2 star</option>
                                            <option value="3">3 star</option>
                                            <option value="5">4 star</option>
                                            <option value="5">5 star</option>
                                        </select>

                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <textarea required="required" placeholder="Your review *" class="form-control" name="review" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        @if(Auth::check())
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                        @else
                                        <p>Please at first login to your account for submit a review.</p>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="small_divider"></div>
                <div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="heading_s1">
                    <h3>Releted Products</h3>
                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "992":{"items": "2"}, "1199":{"items": "3"}}'>
                    @foreach($related_product as $row)
                    <div class="item">
                        <div class="product">
                            <div class="product_img">
                                <a href="shop-product-detail.html">
                                    <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>Add To Cart</a></li>
                                        <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                        <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title">
                                <a href="{{ route('campaign.product.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                </h6>
                                <div class="product_price">
                                    <span class="price">{{ $setting->currency }}{{ $product->selling_price }}</span>
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:87%"></div>
                                    </div>
                                    <span class="rating_num">(25)</span>
                                </div>
                                <div class="pr_desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa
                                        enim. Nullam id varius nunc id varius nunc.</p>
                                </div>
                                @isset($product->color)
                                <div class="pr_switch_wrap">
                                    <div class="product_color_switch">
                                        @foreach($color as $row)
                                        <span data-color="{{ $row }}"></span>
                                        @endforeach
                                    </div>
                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 mt-4 pt-2 mt-lg-0 pt-lg-0">
        <div class="sidebar">
            <div class="widget">
                <h5 class="widget_title">Categories</h5>
                <ul class="widget_categories">
                    <li><a href="#"><span class="categories_name">Women</span><span class="categories_num">(9)</span></a></li>
                    <li><a href="#"><span class="categories_name">Top</span><span class="categories_num">(6)</span></a>
                    </li>
                    <li><a href="#"><span class="categories_name">T-Shirts</span><span class="categories_num">(4)</span></a></li>
                    <li><a href="#"><span class="categories_name">Men</span><span class="categories_num">(7)</span></a>
                    </li>
                    <li><a href="#"><span class="categories_name">Shoes</span><span class="categories_num">(12)</span></a></li>
                </ul>
            </div>
            <div class="widget">
                <h5 class="widget_title">Recent Items</h5>
                <ul class="widget_recent_post">
                    <li>
                        <div class="post_img">
                            <a href="#"><img src="{{asset('front')}}/images/shop_small1.jpg" alt="shop_small1"></a>
                        </div>
                        <div class="post_content">
                            <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">Lether Gray
                                    Tuxedo</a></h6>
                            <div class="product_price"><span class="price">$55.00</span><del>$95.00</del></div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:68%"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post_img">
                            <a href="#"><img src="{{asset('front')}}/images/shop_small2.jpg" alt="shop_small2"></a>
                        </div>
                        <div class="post_content">
                            <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">woman full sliv
                                    dress</a></h6>
                            <div class="product_price"><span class="price">$68.00</span><del>$99.00</del></div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:87%"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post_img">
                            <a href="#"><img src="{{asset('front')}}/images/shop_small3.jpg" alt="shop_small3"></a>
                        </div>
                        <div class="post_content">
                            <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">light blue
                                    Shirt</a></h6>
                            <div class="product_price"><span class="price">$69.00</span><del>$89.00</del></div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:70%"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="widget">
                <h5 class="widget_title">tags</h5>
                <div class="tags">
                    <a href="#">General</a>
                    <a href="#">Design</a>
                    <a href="#">jQuery</a>
                    <a href="#">Branding</a>
                    <a href="#">Modern</a>
                    <a href="#">Blog</a>
                    <a href="#">Quotes</a>
                    <a href="#">Advertisement</a>
                </div>
            </div>
            <div class="widget">
                <div class="shop_banner">
                    <div class="banner_img overlay_bg_20">
                        <img src="{{asset('front')}}/images/sidebar_banner_img.jpg" alt="sidebar_banner_img">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    //store coupon ajax call
    $('#add_to_cart').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#add_to_cart')[0].reset();
                cart();
            }
        });
    });
</script>
@endsection