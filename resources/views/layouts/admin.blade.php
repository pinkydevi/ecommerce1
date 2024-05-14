<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>My Shop</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{url($setting->favicon)}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/toastr/toastr.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Brands -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <!-- Button -->
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @guest

      @else
      <div class="navbar-bg"></div>
      @include('layouts.admin_partial.navbar')
      @include('layouts.admin_partial.sidebar')
      @endguest
      <!-- Main Content -->
      @yield('admin_content')
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('admin')}}/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="{{asset('admin')}}/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin')}}/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="{{asset('admin')}}/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="{{asset('admin')}}/js/custom.js"></script>
  <script type="text/javascript" src="{{ asset('admin/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('admin/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  
  <!-- EX -->
  <!-- overlayScrollbars -->
  <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
  <!-- Button -->
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('admin') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="{{ asset('admin') }}/plugins/raphael/raphael.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="{{ asset('admin') }}/plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin') }}/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard2.js') }}"></script>

  <script type="text/javascript" src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

      <script>  
          $(document).on("click", "#delete", function(e){
              e.preventDefault();
              var link = $(this).attr("href");
                  swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                      swal("Safe Data!");
                    }
                  });
              });
      </script>
    {{-- before  logout showing alert message --}}
      <script>  
          $(document).on("click", "#logout", function(e){
              e.preventDefault();
              var link = $(this).attr("href");
                  swal({
                    title: "Are you Want to logout?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                      swal("Not Logout!");
                    }
                  });
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

  <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/jszip/jszip.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
  <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    })
  </script>
  <script src="{{ asset('admin') }}/plugins/print_this/printThis.js"></script> 
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>
</html>