<div class="bottom_header light_skin main_menu_uppercase bg_dark  mb-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                <div class="categories_wrap">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent" aria-expanded="false" class="categories_btn">
                        <i class="linearicons-menu"></i><span>All Categories </span>
                    </button>
                    <div id="navCatContent" class="nav_cat navbar nav collapse">
                        <ul>
                            @foreach($category as $row)
                            @php
                            $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                            @endphp
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="{{ route('categorywise.product',$row->id) }}"><img src="{{ asset($row->icon) }}" height="32" width="32"> <span>{{ substr($row->category_name, 0, 20) }}</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-7">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        @php
                                                        $chunkedSubcategories = $subcategory->chunk(ceil(count($subcategory) / 4));
                                                        @endphp
                                                        @foreach($chunkedSubcategories[0] as $row)
                                                        @php
                                                        $childcategory=DB::table('childcategories')->where('subcategory_id',$row->id)->get();
                                                        @endphp
                                                        <li class="dropdown-header"><a href="{{ route('subcategorywise.product',$row->id) }}">{{ $row->subcategory_name }}</a></li>
                                                        @foreach($childcategory as $child)
                                                        <li><a class="dropdown-item nav-link nav_item" href="{{ route('childcategorywise.product',$child->id) }}">{{ $child->childcategory_name }}</a></li>
                                                        @endforeach
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        @if(isset($chunkedSubcategories[1]))
                                                        @foreach($chunkedSubcategories[1] as $row)
                                                        @php
                                                        $childcategory=DB::table('childcategories')->where('subcategory_id',$row->id)->get();
                                                        @endphp
                                                        <li class="dropdown-header"><a href="{{ route('subcategorywise.product',$row->id) }}">{{ $row->subcategory_name }}</a></li>
                                                        @foreach($childcategory as $child)
                                                        <li><a class="dropdown-item nav-link nav_item" href="{{ route('childcategorywise.product',$child->id) }}">{{ $child->childcategory_name }}</a></li>
                                                        @endforeach
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="more_categories">More Categories</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                        <ul class="navbar-nav">
                            <li><a class="nav-link nav_item" href="{{ url('/') }}">Home</a></li>
                            <li><a class="nav-link nav_item" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    @php
                    $wishlist=DB::table('wishlists')->where('user_id',Auth::id())->count();
                    @endphp
                    <ul class="navbar-nav attr-nav align-items-center">
                        <li><a href="{{ route('wishlist') }}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">{{ $wishlist }}</span></a></li>
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="{{ route('cart') }}"><i class="linearicons-cart"></i><span class="cart_count">{{ Cart::count() }}</span><span class="amount"><span class="currency_symbol">{{ $setting->currency }}</span>{{ Cart::total() }}</span></a>
                            <div class="cart_box dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    @foreach($content as $row)
                                    <li>
                                        <a href="#" data-id="{{ $row->rowId }}" id="removeProduct" class="item_remove"><i class="ion-close"></i></a>
                                        <a href="#"><img src="{{ asset($row->options->thumbnail) }}" alt="cart_thumb1">{{ substr($row->name,0,15) }}..</a>
                                        <span class="cart_quantity"> {{$row->qty }} x <span class="cart_amount"> <span class="price_symbole">{{ $setting->currency }}</span></span>{{ $row->price }} </span>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_total">{{ $setting->currency }}{{ Cart::total() }}</p>
                                    <p class="cart_buttons"><a href="{{ route('cart.empty') }}" class="btn btn-fill-line view-cart">Empty Cart</a><a href="{{ route('checkout') }}" class="btn btn-fill-out checkout">Checkout</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="pr_search_icon">
                        <a href="javascript:;" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '#removeProduct', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{ url('
            cartproduct / remove / ') }}/' + id,
            type: 'get',
            async: false,
            success: function(data) {
                toastr.success(data);
                location.reload();
            }
        });
    });
</script>