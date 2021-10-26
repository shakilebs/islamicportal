@extends('layouts.admin_master')
@section('title','Category Edit | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Category Edit</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Category Edit</li>
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
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Category Edit Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="editCategory" class="form-horizontal" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
              	<input name="_method" type="hidden" value="PATCH"> 	
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_name">Category Name</label>
                        <input type="text" name="cat_name" class="form-control" id="cat_name" placeholder="Enter category name" value="{{$category->cat_name}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_name_bn">Category Name BN</label>
                        <input type="text" name="cat_name_bn" class="form-control" id="cat_name_bn" placeholder="Enter catgory name bangla" value="{{$category->cat_name_bn}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="content_type">Content type</label>
                        <input type="text" name="content_type" class="form-control" id="content_type" placeholder="Content type here" value="{{$category->content_type}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_code">Category Code</label>
                        <input type="text" name="cat_code" class="form-control" id="cat_code" placeholder="Enter category code here" value="{{$category->cat_code}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_code">Category Icon</label>
                        <input type="file" name="icon" class="form-control" id="cat_icon">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="cat_code">Status</label>
                        <select class="form-control" name="status">
                          <option value="1" {{($category->status ==1)?'selected':''}}>Enable</option>
                          <option value="2" {{($category->status ==2)?'selected':''}}>Disable</option>
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('categories.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
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
  
  $('#editCategory').validate({
    rules: {
      cat_name: {
        required: true,
      },
      cat_name_bn: {
        required: true,
      },
      cat_code: {
        required: true
      },
      content_type: {
        required: true
      },
      
    },
    messages: {
      cat_name: {
        required: "Please enter a category name",
      },
      cat_name_bn: {
        required: "Please enter category name in bangla",
      },
      cat_code: {
        required: "Please enter category Code"
      },
      content_type: {
        required: "Please enter Content type"
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