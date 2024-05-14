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
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
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
                <div class="col-md-7">
                    <div class="heading_s1">
                        <h4>Billing Details</h4>
                    </div>
                    <form action="{{ route('order.place') }}" method="post" id="order-place">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" required="" class="form-control" name="c_name" placeholder="Customer Name *" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" required="" class="form-control" name="c_phone" placeholder="Customer Phone *" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" required="" type="text" name="c_country" placeholder="Country">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="c_address" required="" placeholder="Shipping Address *">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8 mb-3">
                                <input type="text" class="form-control" name="c_email" required="" placeholder="Email Address">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <input class="form-control" required type="text" name="c_zipcode" placeholder="Zip Code *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <input class="form-control" required type="text" name="c_city" placeholder="City Name *">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <input class="form-control" required type="text" name="c_extra_phone" placeholder="Extra Phone *">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 mb-3">
                                <input class="form-check-input" type="checkbox" name="payment_type" id="createaccount" value="Aamarpay">
                                <label class="form-check-label label_info" for="createaccount"><span>credit card</span></label>
                            </div>
                            <div class="form-group col-md-4 mb-3"> <input class="form-check-input" type="checkbox" name="payment_type" id="" value="Aamarpay">
                                <label class="form-check-label label_info" for="createaccount"><span>Bkash/Rocket/Nagad</span></label>
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <input class="form-check-input" type="checkbox" name="payment_type" id="" value="Hand Cash">
                                <label class="form-check-label label_info" for="createaccount"><span>Hand Cash</span></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                        </div>
                        <span class="visually-hidden pl-2 d-none progress">Progressing.....</span>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td>{{ Cart::subtotal() }}{{ $setting->currency }}</td>
                                    </tr>
                                    @if(Session::has('coupon'))
                                    <tr>
                                        <td>coupon:({{ Session::get('coupon')['name'] }}) <span class="product-qty"><a href="{{ route('coupon.remove') }}" class="text-danger">X</a></span>
                                        </td>
                                        <td>{{ Session::get('coupon')['discount'] }} {{ $setting->currency }}</td>
                                    </tr>
                                    @else
                                    @endif
                                    <tr>
                                        <td>Tax:</td>
                                        <td>0.00 %</td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>shipping:</td>
                                        <td>0.00 {{ $setting->currency }}</td>
                                    </tr>
                                    @if(Session::has('coupon'))
                                    <tr>
                                        <th>Total: </th>
                                        <td class="product-subtotal">{{ Session::get('coupon')['after_discount'] }}
                                            {{ $setting->currency }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Total: </th>
                                        <td class="product-subtotal">{{ Cart::total() }} {{ $setting->currency }}</td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            @if(!Session::has('coupon'))
                            <form action="{{ route('apply.coupon') }}" method="post">
                                @csrf
                                <div class="coupon field_form input-group">
                                    <input type="text" value="" class="form-control form-control-sm" name="coupon" placeholder="Enter Coupon Code..">
                                    <div class="input-group-append">
                                        <button class="btn btn-fill-out btn-sm" type="submit">Apply Coupon</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '#removeProduct', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ url('cartproduct / remove / ') }}/' + id,
            type: 'get',
            async: false,
            success: function(data) {
                toastr.success(data);
                location.reload();
            }
        });
    });
    //qty update with ajax
    $('body').on('blur', '.qty', function() {
        let qty = $(this).val();
        let rowId = $(this).data('id');
        $.ajax({
            url: '{{ url('
            cartproduct / updateqty / ') }}/' + rowId + '/' + qty,
            type: 'get',
            async: false,
            success: function(data) {
                toastr.success(data);
                location.reload();
            }
        });
    });
    //color update
    $('body').on('change', '.color', function() {
        let color = $(this).val();
        let rowId = $(this).data('id');
        $.ajax({
            url: '{{ url('
            cartproduct / updatecolor / ') }}/' + rowId + '/' + color,
            type: 'get',
            async: false,
            success: function(data) {
                toastr.success(data);
                location.reload();
            }
        });
    });
    //size update
    $('body').on('change', '.size', function() {
        let size = $(this).val();
        let rowId = $(this).data('id');
        $.ajax({
            url: '{{ url('
            cartproduct / updatesize / ') }}/' + rowId + '/' + size,
            type: 'get',
            async: false,
            success: function(data) {
                toastr.success(data);
                location.reload();
            }
        });
    });
    $('#order-place').submit(function(e) {
        $('.progress').removeClass('d-none');
    });
</script>

@endsection