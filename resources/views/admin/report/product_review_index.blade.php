@extends('layouts.admin')
@section('admin_content')
<div class="main-content">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Product Review</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Review List </h3>
              </div><br>
              <div class="row p-2">
              	<div class="form-group col-3">
              		<label>predicted_emotion</label>
              		 <select class="form-control submitable" name="predicted_emotion" id="predicted_emotion">
              		 	<option >All</option>
              		 	    <option value="0">Anger</option>
  							<option value="1">Boredom</option>
  							<option value="2">Empty</option>
  							<option value="3">Enthusiasm</option>
  							<option value="4">Fun</option>
  							<option value="5">Happiness</option>
                            <option value="6">Hate</option>
  							<option value="7">Love</option>
  							<option value="8">Neutral</option>
  							<option value="9">Relief</option>
  							<option value="10">Sadness</option>
  							<option value="11">Surprise</option>
                            <option value="12">Worry</option>
              		 </select>
              	</div>
                <div class="col-6">
              	</div>
              	<div class="col-2">
              		<button class="btn btn-info print" style="float:right;"><span class="loader d-none">..loading</span> Print </button>
              	</div>
              </div>
              
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>User photo</th>
                      <th>user</th>
                      <th>Product Name</th>
                      <th>review</th>
                      <th>rating</th>
                      <th>Predicted Emotion</th>
                      <th>Review Date</th>
                      <th>Review Month</th>
                      <th>Review Year</th>
                    </tr>
                    </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('product.review.report.index') }}", 
		        "data":function(e) { 
                    e.predicted_emotion =$("#predicted_emotion").val();

		        }
		      },
            columns:[{
          data: 'user_photo',
          name: 'user_photo',
          render: function(data, type, full, meta) {
            // Transform and prepend the base URL to the user_photo URL
            var imageUrl = data.replace('', '/');
            var fullImageUrl = imageUrl;
            console.log("Full Image URL:", imageUrl); // Log the full image URL
            return '<img src="' + fullImageUrl + '"  width="50px" />';
          }
        },
                {data:'email', name:'email'},
                {data:'name', name:'name'},
                {data:'review', name:'review'},
                {data:'rating', name:'rating'},
                {data:'predicted_emotion', name:'predicted_emotion'},
                {data:'review_date', name:'review_date'},
                {data:'review_month', name:'review_month'},
                {data:'review_year', name:'review_year'},
            ]
		});
	});


//submitable class call for every change
  $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('blur','.submitable_input', function(){
      $('.ytable').DataTable().ajax.reload();
  });

$('.print').on('click', function (e) {
    e.preventDefault();
    $('.loader').removeClass('d-none');
    $.ajax({
        url:"{{ route('product.review.report.print') }}",
        type:'get',
        data: {status : $('#status').val(), date: $('#date').val() , payment_type: $('#payment_type').val()},
        success:function(data){
            $('.loader').addClass('d-none');
            $(data).printThis({
                debug: false,                   
                importCSS: true,                
                importStyle: true,                               
                removeInline: false, 
                printDelay: 500,
                header : null,   
                footer : null,
            });
        }
    });
});

</script>
@endsection