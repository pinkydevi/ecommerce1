<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('front')}}/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{asset('front')}}/css/animate.css">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{asset('front')}}/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{asset('front')}}/css/all.min.css">
<link rel="stylesheet" href="{{asset('front')}}/css/ionicons.min.css">
<link rel="stylesheet" href="{{asset('front')}}/css/themify-icons.css">
<link rel="stylesheet" href="{{asset('front')}}/css/linearicons.css">
<link rel="stylesheet" href="{{asset('front')}}/css/flaticon.css">
<link rel="stylesheet" href="{{asset('front')}}/css/simple-line-icons.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{asset('front')}}/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{asset('front')}}/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="{{asset('front')}}/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{asset('front')}}/css/magnific-popup.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{asset('front')}}/css/slick.css">
<link rel="stylesheet" href="{{asset('front')}}/css/slick-theme.css">
<!-- Style CSS -->
<link rel="stylesheet" href="{{asset('front')}}/css/style.css">
<link rel="stylesheet" href="{{asset('front')}}/css/responsive.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/toastr/toastr.css') }}">

</head>

<body>

<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->

<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="lng_dropdown me-2">
                            <select name="countries" class="custome_select">
                                <option value='en' data-image="{{asset('front')}}/images/eng.png" data-title="English">English</option>
                                <option value='fn' data-image="{{asset('front')}}/images/fn.png" data-title="France">France</option>
                                <option value='us' data-image="{{asset('front')}}/images/us.png" data-title="United States">United States</option>
                            </select>
                        </div>
                        <div class="me-3">
                            <select name="countries" class="custome_select">
                                <option value='USD' data-title="USD">USD</option>
                                <option value='EUR' data-title="EUR">EUR</option>
                                <option value='GBR' data-title="GBR">GBR</option>
                                <option value='Taka' data-title="Taka">Taka</option>
                            </select>
                        </div>
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>{{ $setting->phone_one }}</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                	<div class="text-center text-md-end">
                       	<ul class="header_list">
                            <li><a href="{{ route('wishlist') }}"><i class="ti-heart"></i><span>Wishlist</span></a></li>
                            @guest
                            <li><a href="{{ route('login') }}"><i class="ti-user"></i><span>Login</span></a></li>
                            @endguest
                            @if(Auth::check())
                            <li><a href="{{ route('home') }}"><i class="ti-user"></i><span>{{ Auth::user()->name }}</span></a></li>
                            <li><a href="{{ route('customer.logout') }}"><i class="ti-user"></i><span>Logout</span></a></li>   
                            @endif

						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-header dark_skin">
    	<div class="container">
        	<div class="nav_block">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo_light" src="{{ asset( $setting->logo ) }}" alt="logo" />
                    <img class="logo_dark" src="{{ asset( $setting->logo ) }}" alt="logo" />
                </a>
                <div class="contact_phone order-md-last">
                    <i class="linearicons-phone-wave"></i>
                    <span>{{ $setting->phone_one }}</span>
                </div>
                <div class="product_search_form">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="custom_select">
                                    <select class="first_null">
                                        <option value="">All Category</option>
                                        <option value="Dresses">Dresses</option>
                                        <option value="Shirt-Tops">Shirt & Tops</option>
                                        <option value="T-Shirt">T-Shirt</option>
                                        <option value="Pents">Pents</option>
                                        <option value="Jeans">Jeans</option>
                                    </select>
                                </div>
                            </div>
                            <input class="form-control" placeholder="Search Product..." required=""  type="text" name="q">
                            <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- END HEADER -->

@yield('content')

@php 
        $pages_one=DB::table('pages')->where('page_position',1)->get();
        $pages_two=DB::table('pages')->where('page_position',2)->get();
    @endphp
<!-- START FOOTER -->
<footer class="bg_gray">
	<div class="footer_top small_pt pb_20">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img src="{{ asset( $setting->logo ) }}" alt="logo"/></a>
                        </div>
                        <p class="mb-3">If you are going to use of Lorem Ipsum need to be sure there isn't anything hidden of text</p>
                        <ul class="contact_info">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{ $setting->address }}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:info@sitename.com">{{ $setting->main_email }}</a>	
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{ $setting->phone_two }}</p>
                            </li>
                        </ul>
                    </div>
        		</div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            @foreach($pages_one as $row)
                            <li><a href="{{ route('view.page',$row->page_slug) }}">{{ $row->page_name }}</a></li>
                            @endforeach
                            <li><a href="#">Location</a></li>
                            <li><a href="#">Affiliates</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">My Account</h6>
                        <ul class="widget_links">
                            <li><a href="{{ route('home') }}">My Account</a></li>
                            <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                            <li><a href="{{ route('wishlist') }}">Wish List</a></li>
                            <li><a href="{{ route('blog') }}">Our Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                	<div class="widget">
                        <h6 class="widget_title">Instagram</h6>
                        <ul class="widget_instafeed instafeed_col4">
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img1.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img2.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img3.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img4.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img5.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img6.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img7.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                            <li><a href="#"><img src="{{asset('front')}}/images/insta_img8.jpg" alt="insta_img"><span class="insta_icon"><i class="ti-instagram"></i></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_footer">
    	<div class="container">
        	<div class="row">
            	<div class="col-12">
                	<div class="shopping_info">
                        <div class="row justify-content-center">
                            <div class="col-md-4">	
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-shipped"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Free Delivery</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">	
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-money-back"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>30 Day Returns Guarantee</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">	
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>27/4 Online Support</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <p class="mb-lg-0 text-center">© 2024 All Rights Reserved by Bestwebcreator</p>
                </div>
                <div class="col-lg-4 order-lg-first">
                	<div class="widget mb-lg-0">
                        <ul class="social_icons text-center text-lg-start">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://jorenvanhocht.be" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be" class="sc_twitter"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://jorenvanhocht.be&amp;title=my share text&amp;summary=dit is de linkedin summary" class="sc_linkedin"><span class="fa fa-linkedin"></span></a></li>
                            <li><a href="https://wa.me/?text=http://jorenvanhocht.be" class="sc_whatsapp "><span class="fa fa-whatsapp"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="footer_payment text-center text-lg-end">
                        <li><a href="#"><img src="{{asset('front')}}/images/visa.png" alt="visa"></a></li>
                        <li><a href="#"><img src="{{asset('front')}}/images/discover.png" alt="discover"></a></li>
                        <li><a href="#"><img src="{{asset('front')}}/images/master_card.png" alt="master_card"></a></li>
                        <li><a href="#"><img src="{{asset('front')}}/images/paypal.png" alt="paypal"></a></li>
                        <li><a href="#"><img src="{{asset('front')}}/images/amarican_express.png" alt="amarican_express"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<!-- Share Icon -->
<script src="{{ asset('js/share.js') }}"></script>
<!-- Latest jQuery --> 
<script src="{{asset('front')}}/js/jquery-3.7.1.min.js"></script>
<!-- popper min js -->
<script src="{{asset('front')}}/js/popper.min.js"></script>
<!-- Latest compiled and minified Bootstrap --> 
<script src="{{asset('front')}}/bootstrap/js/bootstrap.min.js"></script> 
<!-- owl-carousel min js  --> 
<script src="{{asset('front')}}/owlcarousel/js/owl.carousel.min.js"></script> 
<!-- magnific-popup min js  --> 
<script src="{{asset('front')}}/js/magnific-popup.min.js"></script> 
<!-- waypoints min js  --> 
<script src="{{asset('front')}}/js/waypoints.min.js"></script> 
<!-- parallax js  --> 
<script src="{{asset('front')}}/js/parallax.js"></script> 
<!-- countdown js  --> 
<script src="{{asset('front')}}/js/jquery.countdown.min.js"></script> 
<!-- imagesloaded js --> 
<script src="{{asset('front')}}/js/imagesloaded.pkgd.min.js"></script>
<!-- isotope min js --> 
<script src="{{asset('front')}}/js/isotope.min.js"></script>
<!-- jquery.dd.min js -->
<script src="{{asset('front')}}/js/jquery.dd.min.js"></script>
<!-- slick js -->
<script src="{{asset('front')}}/js/slick.min.js"></script>
<!-- elevatezoom js -->
<script src="{{asset('front')}}/js/jquery.elevatezoom.js"></script>
<!-- scripts js --> 
<script src="{{asset('front')}}/js/scripts.js"></script>
<!-- icon scripts js --> 
<script src="https://kit.fontawesome.com/4fe50ff908.js" crossorigin="anonymous"></script>

<script src="{{ asset('front/ex') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('front/ex') }}/styles/bootstrap4/popper.js"></script>
<script src="{{ asset('front/ex') }}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('front/ex') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('front/ex') }}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('front/ex') }}/plugins/easing/easing.js"></script>
<script src="{{ asset('front/ex') }}/js/custom.js"></script>
<script src="{{ asset('front/ex') }}/js/product_custom.js"></script>
<script type="text/javascript" src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>


 <script type="text/javascript" charset="utf-8">
    function cart() {
         $.ajax({
            type:'get',
            url:'{{ route('all.cart') }}', 
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
    }
    $(document).ready(function(event) {
        cart();
    });
    
 </script>

   <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
                }
        @endif
    </script>

</body>
</html>