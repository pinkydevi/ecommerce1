@php 
  $setting=DB::table('settings')->first();
@endphp
<style>
    /* Normal state */
    .header-logo:hover {
        box-shadow: 0 0 10px red; /* Add a red glow effect */
        transition: box-shadow 0.3s ease; /* Smooth transition */
    }
</style>
<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('admin.home') }}"> <img alt="image" src="{{url($setting->favicon)}}" class="header-logo" /> <span
                class="logo-name">My Shop</span> 
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="{{ route('admin.home') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            @if(Auth::user()->category==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="grid"></i><span>Category</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('category.index') }}">Category</a></li>
                <li><a class="nav-link" href="{{ route('subcategory.index') }}">Sub Category</a></li>
                <li><a class="nav-link" href="{{ route('childcategory.index') }}">Child Category</a></li>
                <li><a class="nav-link" href="{{ route('brand.index') }}">Brand</a></li>
                <li><a class="nav-link" href="{{ route('warehouse.index') }}">Warehouse</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->product==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="box"></i><span>Product</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('product.create') }}">New Product</a></li>
                <li><a class="nav-link" href="{{ route('product.index') }}">Manage Product</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->offer==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="gift"></i><span>Offer</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('coupon.index') }}">Coupon</a></li>
                <li><a class="nav-link" href="{{ route('campaign.index') }}">E Campaign</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->order==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="shopping-cart"></i><span>Orders</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.order.index') }}">Orders</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->pickup==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="truck"></i><span>Pickup Point</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('pickuppoint.index') }}">Pickup Point</a></li>
              </ul>
            </li>
            @endif 

            @if(Auth::user()->ticket==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="users"></i><span>Ticket</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('ticket.index') }}">Ticket</a></li>
              </ul>
            </li>
            @endif

            

            @if(Auth::user()->report==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="file-text"></i><span>Reports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('report.order.index') }}">Order report</a></li>
                <li><a class="nav-link" href="{{ route('product.review.report.index') }}">Product review report</a></li>
                <li><a class="nav-link" href="{{ route('web.review.report.index') }}">Web review report</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->setting==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="settings"></i><span>Settings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('seo.setting') }}">SEO Setting</a></li>
                <li><a class="nav-link" href="{{ route('website.setting') }}">Website Setting</a></li>
                <li><a class="nav-link" href="{{ route('page.index') }}">Page Create</a></li>
                <li><a class="nav-link" href="{{ route('smtp.setting') }}">SMTP Setting</a></li>
                <li><a class="nav-link" href="{{ route('payment.gateway') }}">Payment Gateway</a></li>
                <li><a class="nav-link" href="{{ route('profile.setting') }}">Profile</a></li>
              </ul>
            </li>
            @endif

            @if(Auth::user()->userrole==1)
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>User Role</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('create.role') }}">Create New Role</a></li>
                <li><a class="nav-link" href="{{ route('manage.role') }}">Manage Role</a></li>
              </ul>
            </li>
            @endif
          </ul>
        </aside>
      </div>