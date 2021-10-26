@extends('layouts.admin_master')
@section('title','Edit user | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Edit user</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit user</li>
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
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Edit user Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userEdit" class="form-horizontal" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter user name" value="{{$user->name}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter user email" value="{{$user->email}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="+8801*********" value="{{$user->phone}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="given your address" value="{{$user->address}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="roles">Assign Role</label>
                        <select class="form-control select2" multiple name="roles[]">
                          <option value="">Select Role</option>
                          @foreach($roles as $role)
                          <option value="{{$role->id}}" {{$user->hasRole($role->name)?'selected':''}}>{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="****">
                      </div>
                    </div>
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('users.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
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
  $('#userEdit').validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
      },
      phone: {
        required: true
      },
      
      
      
    },
    messages: {
      name: {
        required: "Please enter name in bangla",
      },
      email: {
        required: "Arabic name is required",
      },
      phone: {
        required: "phone is required"
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