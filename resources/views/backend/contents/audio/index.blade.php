@extends('layouts.admin_master')
@section('title','Audio Content | Islamic Portal')
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
            <h4>Audio Content</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Audio Content</li>
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
                <h5 class="card-title">Audio Content</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('audio-contents.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("audio-contents.create")}}'>Add Content</a>
                    @endif
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="audioContentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Content ID</th>
                    <th>Category Name</th>
                    <th>Content Title</th>
                    <th>Title BN</th>
                    <th>Content Type</th>
                    <th>Audio</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($audioContentList as $key => $audio)
	                  <tr>
	                    <td><b>{{$audio->content_id}}</b></td>
	                    <td>{{$audio->category->cat_name}}</td>
                      <td>{{$audio->content_title}}</td>
	                    <td>{{$audio->content_title_bn}}</td>
	                    <td>{{$audio->content_type}}</td>
                      <td align="center" class="text-center">
                        <audio id="onplayAudio_{{$audio->id}}" class="audioFiles">
                          <source src='{{asset("uploads/contents/audio/$audio->file_name")}}' type="audio/mpeg"> 
                        </audio>
                        <a onclick="playAudio({{$audio->id}})" class="audioPlay"><i class="fas fa-play"></i></a>
                      </td>
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('audio-contents.edit'))
                            <a href="{{route('audio-contents.edit', $audio->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('audio-contents.destroy'))
                            <a onclick="confirm_modal('{{route('audio-contents.destroy', $audio->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                      </td>
	                  </tr>
	                @empty
	                <tr>
	                	<td colspan="6" align="center"><h4>No Content found! <i class="far fa-frown"></i></h4></td>
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
    
    $('#audioContentTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
  });
  
  function playAudio(id){
    var audioFile = document.getElementById("onplayAudio_"+id);
    console.log(audioFile);
    
    return audioFile.paused ? audioFile.play() : audioFile.pause();
  }
  

</script>
@endsection