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
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="card">
                                <div class="card-header"><h3>All Tickets<a href="{{ route('new.ticket') }}" class="btn btn-sm btn-danger" style="float:right;">Open Ticket</a></h3></div>

                                <div class="card-body">
                                    <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Subject<span class="required">*</span></label>
                                                <input required="" class="form-control" name="subject" type="text" required>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Priority<span class="required">*</span></label>
                                                <div class="custom_select">
                                                    <select class="form-control"name="priority">
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Service<span class="required">*</span></label>
                                                <div class="custom_select">
                                                    <select class="form-control"name="service">
                                                    <option value="Technical">Technical</option>
                                                    <option value="Payment">Payment</option>
                                                    <option value="Affiliate">Affiliate</option>
                                                    <option value="Return">Return</option>
                                                    <option value="Refund">Refund</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 mb-3">
                                                <textarea required="required" placeholder="Your review *" class="form-control"
                                                    name="message" rows="4"></textarea>
                                            </div>
                                            <div>
                                                <label for="exampleInputPassword1">Image</label>
                                                <input type="file" class="form-control" name="image" >
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit"
                                                    value="Submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
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