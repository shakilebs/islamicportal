@extends('layouts.admin_master')
@section('title','Permission List| Islamic Portal')
@section('content')
<style type="text/css">
  .audioPlay i{
    color: #ff0000;
    font-size: 18px;
  }
</style>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Permission List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Permission List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Permission List</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('permissions.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='#' data-toggle="modal" data-target="#permissionModalAdd">Add Permission</a>
                   @endif

                    <!-- Permission Add Modal -->

                    <div class="modal fade" id="permissionModalAdd">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Permission</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <form id="addPermission" class="form-horizontal" action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="group_name">Group Name</label>
                                    <input type="text" name="group_name" class="form-control" id="group_name" placeholder="given your group" required="required">
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Permission Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="given your permission" required="required">
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </form>
                          
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    <!--End of Permission Add Modal -->
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="permissionTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Group Name</th>
                    <th>Permission Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($permissionList as $key => $names)
	                  <tr>
	                    <td>{{$names->group_name}}</td>
                      <td>{{$names->name}}</td>
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('permissions.edit'))
                            <a href="#" data-toggle="modal" data-target="#permissionModalEdit{{$names->id}}" class="btn btn-info btn-xs" ><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('permissions.destroy'))
                            <a onclick="confirm_modal('{{route('permissions.destroy', $names->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                        <!-- Permission Edit Modal -->
                        <div class="modal fade" id="permissionModalEdit{{$names->id}}">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Permission</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                <form id="EditPermission" class="form-horizontal" action="{{ route('permissions.update',$names->id) }}" method="POST" enctype="multipart/form-data">
                                  <input name="_method" type="hidden" value="PATCH">  
                                @csrf
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                      <label for="group_name">Group Name</label>
                                      <input type="text" name="group_name" class="form-control" id="group_name" placeholder="given your group" required="required" value="{{$names->group_name}}">
                                    </div>
                                      <div class="form-group">
                                        <label for="name">Permission Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="given your permission" required="required" value="{{$names->name}}">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </form>
                              
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- End of Permission Edit Modal -->
                      </td>
	                  </tr>
	                @empty
	                <tr>
	                	<td colspan="6" align="center"><h4>No names found! <i class="far fa-frown"></i></h4></td>
	                </tr>
	                @endforelse
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script>
  $(function () {
    
    $('#permissionTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#addPermission').validate({
      rules: {
        name: {
          required: true,
        },
        
        
      },
      messages: {
        name: {
          required: "Please enter a permission name",
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