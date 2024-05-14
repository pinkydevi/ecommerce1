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
                                    <h4>My All Order</h4>
                                    <div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Service</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ticket as $row)
                                                <tr>
                                                    <td>{{ date('d F , Y') ,strtotime($row->date)  }}</td>
                                                    <td>{{ $row->service  }}</td>
                                                    <td>{{ $row->subject }}</td>
                                                    <td>@if($row->status==0)
                                                            <span class="badge rounded-pill text-bg-danger">Pending</span>
                                                        @elseif($row->status==1)
                                                            <span class="badge rounded-pill text-bg-success">Replied</span>
                                                        @elseif($row->status==2)
                                                            <span class="badge rounded-pill text-bg-dark">Closed</span> 
                                                        @endif 
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('show.ticket',$row->id) }}" class="btn btn-sm btn-info" title="view order"><i class="fa fa-eye"></i></a>
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