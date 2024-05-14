@extends('layouts.app')
@section('content')
@include('layouts.front_partial.collaps_nav')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Contact</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION CONTACT -->
<div class="section pb_70">
	<div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-map2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Address</span>
                        <p>{{ $setting->address }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-envelope-open"></i>
                    </div>
                    <div class="contact_text">
                        <span>Email Address</span>
                        <a href="mailto:info@sitename.com">{{ $setting->main_email }} </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-tablet2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Phone</span>
                        <p>{{ $setting->phone_two }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CONTACT -->

<!-- START SECTION CONTACT -->
<div class="section pt-0">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-6">
            	<div class="heading_s1">
                	<h2>Get In touch</h2>
                </div>
                <p class="leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                <div class="field_form">
                <form action="{{ route('contactme.submite') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <input required placeholder="Enter Name *" id="name" class="form-control" name="name" type="text" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <input required placeholder="Enter Email *" id="email" class="form-control" name="email" type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <input required placeholder="Enter Phone No. *" id="phone" class="form-control" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <input placeholder="Enter Subject" id="subject" class="form-control" name="subject">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <textarea required placeholder="Message *" class="form-control" name="message" id="message" rows="4"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" title="Submit Your Message!" class="btn btn-fill-out">Send Message</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                <div id="map" class="contact_map2" data-zoom="12"><img src="{{asset('front')}}/images/map.png" alt="insta_img"></div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CONTACT -->

</div>
<!-- END MAIN CONTENT -->

@endsection