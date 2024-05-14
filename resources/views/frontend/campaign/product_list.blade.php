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
                    <h1>Campaign</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Campaign</li>
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
                <div class="col-12">
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
                    <div class="row shop_container loadmore" data-item="8" data-item-show="4" data-finish-message="No More Item to Show" data-btn="Load More">
                        @php
                        $serial = $products->firstItem(); // Get the first item number
                        @endphp
                        @foreach($products as $row)
                        <div class="col-lg-3 col-md-4 col-6 grid_item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset($row->thumbnail) }}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->product_id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $row->product_id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$row->product_id) }}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('campaign.product.details',$row->slug) }}">{{ $row->name }}</a></h6>
                                    <div class="product_price">
                                        <span class="price">{{ $setting->currency }}{{ $row->price }}</span>
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
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div>
                                    <div class="list_product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#" class="quick_view" id="{{ $row->product_id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="#" class="quick_view" id="{{ $row->product_id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></a></li>
                                            <li><a href="{{ route('add.wishlist',$row->product_id) }}"><i class="icon-heart"></i></a></li>
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
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
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