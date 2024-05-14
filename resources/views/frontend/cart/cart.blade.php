@extends('layouts.app')
@section('content')
@include('layouts.front_partial.collaps_nav')


<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Shopping Cart</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Shopping Cart</li>
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
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Name</th>
                                <th class="product-price"> Size</th>
                                <th class="product-quantity">Color</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Price</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach($content as $row)
						@php
						$product=DB::table('products')->where('id',$row->id)->first();
						$colors=explode(',',$product->color);
						$sizes=explode(',',$product->size);
						@endphp
						<tr>
							<td class="product-thumbnail"><a href="#"><img src="{{ asset($row->options->thumbnail) }}" alt="product1"></a></td>
							<td class="product-name" data-title="Product"><a href="#">{{ substr($row->name,0,15) }}..</a></td>
							<td class="product-color" data-title="color">
								@if($row->options->size !=NULL)
									<div class="cart_item_color cart_info_col">
										<div class="cart_item_text">
											<select class="custom-select form-control-sm size" name="size" style="min-width: 100px;" data-id="{{ $row->rowId }}">
												@foreach($sizes as $size)
													<option value="{{ $size }}" @if($size=$row->options->size) selected="" @endif >{{ $size }}</option>
												@endforeach
											</select>
										</div>
									</div>
								@endif
							</td>
							<td class="product-size" data-title="size">
								@if($row->options->color !=NULL)
									<div class="cart_item_color cart_info_col">
										<div class="cart_item_text">
											<select class="custom-select form-control-sm color" data-id="{{ $row->rowId }}" name="color" style="min-width: 100px;">
												@foreach($colors as $color)
													<option value="{{ $color }}" @if($color = $row->options->color) selected="" @endif >{{ $color }}</option>
												@endforeach
											</select>
										</div>
									</div>
								@endif
							</td>
							<td class="product-quantity" data-title="Quantity">
								<input type="number" class="form-control-sm qty" name="qty" style="min-width: 70px;" data-id="{{ $row->rowId }}"  value="{{ $row->qty }}" min="1" required="">
							</td>
							<td class="product-subtotal" data-title="price">{{ $setting->currency }}{{ $row->price }} x {{$row->qty }} </td>
							<td class="product-subtotal" data-title="Total">{{ $setting->currency }} {{ $row->qty*$row->price }}</td>
							<td class="product-remove" data-title="Remove"><a href="#" data-id="{{ $row->rowId }}" id="removeProduct"><i class="ti-close"></i></a></td>
						</tr>
					@endforeach

                        </tbody>
                        <tfoot>
                        	<tr>
                            	<td colspan="5" class="px-0">
                                	<div class="row g-0 align-items-center text-md-end">
                                        <div class="col-lg-8 col-md-6  text-start  text-md-end">
										<td class="cart_total_label">Total:</td>
										<td class="cart_total_amount"><strong>{{ $setting->currency }}{{ Cart::total() }}</strong></td>
                                        </div>
                                    </div>
                                </td>
                            </tr>
							<tr>
							<td colspan="8" class="px-0">
								<div class="row g-0 align-items-center">
									<div class="col-lg-10 col-md-6 text-start text-md-end">
										<a class="btn btn-line-fill btn-sm" href="{{ route('cart.empty') }}">Empty Cart</a>
									</div>
									<div class="col-lg-2 col-md-6 text-start text-md-end">
										<a class="btn btn-fill-out btn-sm" href="{{ route('checkout') }}">Checkout</a>
									</div>
								</div>
							</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- END SECTION SHOP -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">

		 $('body').on('click','#removeProduct', function(){
		    let id=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/remove/') }}/'+id,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //qty update with ajax
		 $('body').on('blur','.qty', function(){
		    let qty=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //color update
		 $('body').on('change','.color', function(){
		    let color=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatecolor/') }}/'+rowId+'/'+color,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //size update
		 $('body').on('change','.size', function(){
		    let size=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatesize/') }}/'+rowId+'/'+size,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

	</script>
@endsection