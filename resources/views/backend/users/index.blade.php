@extends('layouts.admin_master')
@section('title','User List | Islamic Portal')
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
            <h4>User List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
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
                <h5 class="card-title">User List</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('users.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("users.create")}}'>Add User</a>
                  @endif
                    
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="allahNameTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Roles</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($userList as $key => $user)
	                  <tr>
	                    <td>{{$user->name}}</td>
	                    <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->address}}</td>
                      <td>
                        @foreach($user->roles as $role)
                        <span class="badge badge-info mr-1">{{$role->name}}</span>
                        @endforeach
                      </td>
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('users.edit'))
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('users.destroy'))
                            <a onclick="confirm_modal('{{route('users.destroy', $user->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                      </td>
	                  </tr>
	                @empty
	                <tr>
	                	<td colspan="6" align="center"><h4>No user found! <i class="far fa-frown"></i></h4></td>
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
    
    $('#allahNameTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function playAudio(id){
    var audioFile = document.getElementById("onplayAudio_"+id);
    console.log(audioFile);
    
    return audioFile.paused ? audioFile.play() : audioFile.pause();
  }
</script>
@endsection