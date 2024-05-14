@extends('layouts.app')
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Order Completed</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Order Completed</li>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center order_complete">
                        <div class="heading_s1">
                            <h3>Track Your Order Now</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-stretch">
                <!-- Added align-items-stretch -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <!-- Added h-100 class -->
                        <div class="card-body mt-2">
                            Name: {{ $order->c_name }} <br>
                            Phone: {{ $order->c_phone }} <br>
                            OrderID: {{ $order->order_id }} <br>
                            Status: @if($order->status==0)
                            <span class="badge rounded-pill text-bg-danger">Order Pending</span>
                            @elseif($order->status==1)
                            <span class="badge rounded-pill text-bg-info">Order Recieved</span>
                            @elseif($order->status==2)
                            <span class="badge rounded-pill text-bg-primary">Order Shipped</span>
                            @elseif($order->status==3)
                            <span class="badge rounded-pill text-bg-success">Order Done</span>
                            @elseif($order->status==4)
                            <span class="badge rounded-pill text-bg-warning">Order Return</span>
                            @elseif($order->status==5)
                            <span class="badge rounded-pill text-bg-danger">Order Cancel</span>
                            @endif <br>
                            Date: {{ date('d F Y'),strtotime($order->c_name)}} <br>
                            Subtotal: {{ $order->subtotal }} {{ $setting->currency }}<br>
                            Total: {{ $order->total }} {{ $setting->currency }}<br>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card h-100">
                        <!-- Added h-100 class -->
                        <div class="card-header">
                            My Order
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_details as $key=>$row)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $row->product_name  }}</td>
                                            <td>{{ $row->color }} </td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>{{ $row->single_price }} {{ $setting->currency }}
                                            </td>
                                            <td>{{ $row->subtotal_price }} {{ $setting->currency }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
@endsection