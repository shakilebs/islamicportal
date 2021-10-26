@extends('layouts.admin_master')
@section('title','Assign role wise permission| Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Role Add</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Role</li>
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
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Add Role</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="roleName" class="form-horizontal" action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter bangla name" required>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="name">Permissions</label>

                        <div class="form-check">
                          <div class="icheck-info d-inline">
                            <input type="checkbox" id="permissioncheckAll" class="form-check-input" value="1"> 
                          <label  for="permissioncheckAll">
                           Check All
                          </div>

                        </div>
                        <hr>
                        <div class="row">
                          @foreach($permissionGroup as $groups)
                            <div class="col-md-4">
                              <div class="mt-1 mb-1 pt-1">
                                <h5><b>{{$groups->group_name}}</b></h5>

                                  @php 
                                    $permissionList = App\Models\User::getPermissionByGroupName($groups->group_name); 
                                  @endphp

                                  @foreach($permissionList as $permission)
                                  <div class="icheck-info d-inline">
                                      <input type="checkbox" name="permissions[]" id="permissioncheck{{$permission->id}}"  value="{{$permission->id}}"> 
                                      <label  for="permissioncheck{{$permission->id}}">
                                      {{$permission->name}}
                                    </label>
                                    </div>
                                  @endforeach
                              </div>
                            </div>
                          @endforeach
                        </div>
                        
                      </div>
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('roles.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
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
  
  $('#roleName').validate({
    rules: {
      name: {
        required: true,
      }
      
      
    },
    messages: {
      name: {
        required: "Please enter role name",
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
  // Check All javascript---------------
  $('#permissioncheckAll').on('click', function(){
    if($(this).is(':checked')){
      $('input[type=checkbox]').prop('checked',true);
    }else{
      $('input[type=checkbox]').prop('checked',false);
    }
  });
</script>
@endsection