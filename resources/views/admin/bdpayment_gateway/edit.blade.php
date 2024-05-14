@extends('layouts.admin')

@section('admin_content')
<div class="main-content">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payment Gateway</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Payment gateway setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Aamarpay Payment gateway</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('update.aamarpay') }}" method="Post">
                @csrf
                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">StoreID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $aamarpay->store_id }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Signature KEY</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $aamarpay->signature_key }}" required> 
                  </div>
                  <div class="form-group">
                    <input type="checkbox"  name="status" value="1" @if($aamarpay->status==1) checked @endif > 
                    <label for="exampleInputEmail1">Live Server</label>
                    <small>(If checbox are not checked it working for sandbox only)</small>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

@endsection
