@extends('layouts.app')
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
                    <div class="tab-pane" id="account-detail" aria-labelledby="account-detail-tab">
                        <div class="tab-pane">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Ticket Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card  p-2">
                                        <div class="row">
                                            <h3 class="ml-4">Your Ticket Details</h3>
                                            <div class="col-md-9">
                                                <strong>Subject: {{ $ticket->subject }}</strong><br>
                                                <strong>Service: {{ $ticket->service }}</strong><br>
                                                <strong>Priority: {{ $ticket->priority }}</strong><br>
                                                <strong>Message: {{ $ticket->message }}</strong>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ asset($ticket->image) }}" target="_blank"><img
                                                        src="{{ asset($ticket->image) }}"
                                                        style="height:80px; width:120px;"></a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- All reply message show here --}}
                                    @php
                                    $replies=DB::table('replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
                                    @endphp

                                    <div class="card p-2 mt-2">
                                        <strong>All Reply Message.</strong><br>
                                        <div class="card-body" style="height: 450px; overflow-y: scroll;">
                                            @isset($replies)
                                            @foreach($replies as $row)
                                            <div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
                                                <div
                                                    class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
                                                    <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else
                                                    {{ Auth::user()->name }}@endif
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                        <p>{{ $row->message }}</p>
                                                        <footer class="blockquote-footer">
                                                            {{ date('d F Y'),strtotime($row->reply_date) }}</footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <strong>Reply Message.</strong><br>
                                            <div>
                                                <form action="{{ route('reply.ticket') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Message</label>
                                                        <textarea class="form-control" name="message"
                                                            required=""></textarea>
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                    </div>
                                                    <div>
                                                        <label for="exampleInputPassword1">Image</label>
                                                        <input type="file" class="form-control" name="image">
                                                    </div><br>
                                                    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                                                </form>
                                            </div>
                                        </div>
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