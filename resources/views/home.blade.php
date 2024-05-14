@extends('layouts.app')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 2px solid #FF324D;
        /* Added border color */
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #FF324D;
        /* Added color to thead background */
        color: white;
        /* Added color to thead text */
    }

    tr:first-child {
        border-top: none;
    }

    tr:last-child td {
        border-bottom: none;
    }

    table {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Add border between rows */
    tr:not(:first-child) {
        border-top: 2px solid #FF324D;
    }

    /* Add left and right borders */
    td {
        border-left: 2px solid #FF324D;
        border-right: 2px solid #FF324D;
    }

    /* Adjust the borders for the first and last cells */
    td:first-child {
        border-left: none;
    }

    td:last-child {
        border-right: none;
    }
</style>

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>My Account</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">My Account</li>
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
                @include('user.sidebar')
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <a href="">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-success text-center">Total Order</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted text-center">{{ $total_order }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-success text-center">Complete Order
                                                        </h5>
                                                        <h6 class="card-subtitle mb-2 text-muted text-center">{{ $complete_order }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-danger text-center">Cancel Order</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted text-center">{{ $cancel_order }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-warning text-center">Return Order
                                                        </h5>
                                                        <h6 class="card-subtitle mb-2 text-muted text-center">{{ $return_order }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <h4>Recent Order</h4>
                                    <div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col">OrderId</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Payment Type</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $row)
                                                <tr>
                                                    <td>{{ $row->order_id }}</td>
                                                    <td>{{ date('d F , Y') ,strtotime($row->order_id)  }}</td>
                                                    <td>{{ $row->total }} {{ $setting->currency }}</td>
                                                    <td>{{ $row->payment_type }}</td>
                                                    <td>@if($row->status==0)
                                                        <span class="badge rounded-pill text-bg-danger">Order Pending</span>
                                                        @elseif($row->status==1)
                                                        <span class="badge rounded-pill text-bg-info">Order Recieved</span>
                                                        @elseif($row->status==2)
                                                        <span class="badge rounded-pill text-bg-primary">Order Shipped</span>
                                                        @elseif($row->status==3)
                                                        <span class="badge rounded-pill text-bg-success">Order Done</span>
                                                        @elseif($row->status==4)
                                                        <span class="badge rounded-pill text-bg-warning">Order Return</span>
                                                        @elseif($row->status==5)
                                                        <span class="badge rounded-pill text-bg-danger">Order Cancel</span>
                                                        @endif
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
        </div>
    </div>
    <!-- END SECTION SHOP -->
</div>
<!-- END MAIN CONTENT -->

@endsection