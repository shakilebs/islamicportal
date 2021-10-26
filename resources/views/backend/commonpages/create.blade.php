@extends('layouts.admin_master')
@section('title','Common Page | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Common Page Add</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Common Page Add</li>
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
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Page Add Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addText" class="form-horizontal" action="{{ route('common-page.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-6">
                      <div class="form-group">
                        <label for="page_name">Title</label>
                        <input type="text" name="page_name" class="form-control" id="page_name" placeholder="Enter Page title">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="page_name_bn">Title in bangla</label>
                        <input type="text" name="page_name_bn" class="form-control" id="page_name_bn" placeholder="Enter title in bangla">
                      </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                        <label for="page_content">Details</label>
                        <textarea id="page_content" name="page_content" class="form-control" rows="8">
                          
                        </textarea>
                      </div>
                    </div>
                    
                    
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('common-page.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
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
  $('.select2').select2();
  $('#page_content').summernote({
    height: 300
  });
  $('#addText').validate({
    rules: {
      
      page_content: {
        required: true,
      },
      page_name: {
        required: true
      }
      
    },
    messages: {
      
      page_content: {
        required: "add a details",
      },
      page_name: {
        required: "Add a title"
      }
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