@extends('layouts.admin_master')
@section('title','Name List | Islamic Portal')
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
            <h4>Name List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Name List</li>
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
                <h5 class="card-title">Name List</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                  
                  @if(Auth::user()->can('allah-name.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("allah-name.create")}}'>Add Name</a>
                  @endif 
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="allahNameTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name BN</th>
                    <th>Name Arabic</th>
                    <th>Meaning</th>
                    <th>Audio</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($nameList as $key => $names)
	                  <tr>
	                    <td>{{$names->name_bn}}</td>
	                    <td>{{$names->name_ar}}</td>
	                    <td>{{$names->meaning}}</td>
                      <td align="center" class="text-center">
                        <audio id="onplayAudio_{{$names->id}}" class="audioFiles">
                          <source src='{{asset("uploads/contents/allahname/$names->file_name")}}' type="audio/mpeg"> 
                        </audio>
                        @if($names->file_name !=null)
                        <a onclick="playAudio({{$names->id}})" class="audioPlay"><i class="fas fa-play"></i></a>
                        @endif
                      </td>
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('allah-name.edit'))
                            <a href="{{route('allah-name.edit', $names->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('allah-name.destroy'))
                            <a onclick="confirm_modal('{{route('allah-name.destroy', $names->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
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