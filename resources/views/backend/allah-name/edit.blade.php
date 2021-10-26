@extends('layouts.admin_master')
@section('title','Name edit | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Name edit</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Name edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Name edit Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="editName" class="form-horizontal" action="{{ route('allah-name.update', $nameList->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">  
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="name_bn">Name Bangla</label>
                        <input type="text" name="name_bn" class="form-control" id="name_bn" placeholder="Enter bangla name" value="{{$nameList->name_bn}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="name_ar">Name Arabic</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="Enter arabic name" value="{{$nameList->name_ar}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="meaning">Meaning</label>
                        <input type="text" name="meaning" class="form-control" id="meaning" placeholder="Meaning" value="{{$nameList->meaning}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="file_name">Add Audio File</label>
                        <input type="file" name="file_name" class="form-control" id="file_name" placeholder="Enter category code here">
                      </div>
                    </div>
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('allah-name.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script>
  $(function () {
  
  $('#editName').validate({
    rules: {
      name_bn: {
        required: true,
      },
      name_ar: {
        required: true,
      },
      meaning: {
        required: true
      },
      
      
    },
    messages: {
      name_bn: {
        required: "Please enter name in bangla",
      },
      name_ar: {
        required: "Arabic name is required",
      },
      meaning: {
        required: "Meaning is required"
      },
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});

</script>
@endsection