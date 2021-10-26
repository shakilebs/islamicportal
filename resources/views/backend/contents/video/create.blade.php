@extends('layouts.admin_master')
@section('title','Video Content | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Video Content Add</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Video Content Add</li>
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
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Video Add Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addVideo" class="form-horizontal" action="{{ route('video-contents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_name">Select Category</label>
                        <select class="form-control select2" name="cat_id" style="width: 100%;" required>
                          <option value="">Select</option>
                          @foreach($categoryList as $category)
                          <option value="{{$category->id}}">{{$category->cat_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="content_title">Title</label>
                        <input type="text" name="content_title" class="form-control" id="content_title" placeholder="Enter Content title">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="content_title_bn">Title in bangla</label>
                        <input type="text" name="content_title_bn" class="form-control" id="content_title_bn" placeholder="Enter title in bangla">
                      </div>
                    </div>
                    
                    <div class="col-6">
                      <div class="form-group">
                        <label for="content_type">Content type</label>
                        <input type="text" name="content_type" class="form-control" id="content_type" placeholder="Content type here">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="file_name">Add Video File</label>
                        <input type="file" name="file_name" class="form-control" id="file_name" placeholder="Enter category code here">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_name">Select Service</label>
                        <select class="form-control" name="service_id" style="width: 100%;" required>
                          <option>Select</option>
                          @foreach($serviceList as $service)
                          <option value="{{$service->id}}">{{$service->service_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('video-contents.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
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
  $('.select2').select2()
  $('#addVideo').validate({
    rules: {
      cat_id: {
        required: true,
      },
      file_name: {
        required: true,
      },
      content_title: {
        required: true
      },
      content_title_bn: {
        required: true
      },
      
    },
    messages: {
      cat_id: {
        required: "Please enter a category name",
      },
      file_name: {
        required: "Add a audio file",
      },
      content_title: {
        required: "Add a title"
      },
      content_title_bn: {
        required: "Add title in bangla"
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