@extends('layouts.admin_master')
@section('title','Video Content | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Video Content</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Video Content</li>
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
                <h5 class="card-title">Video Content</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('video-contents.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("video-contents.create")}}'>Add Content</a>
                    @endif
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="videoContentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Content ID</th>
                    <th>Category Name</th>
                    <th>Content Title</th>
                    <th>Title BN</th>
                    <th>Content Type</th>
                    <th>Video</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($videoContentList as $key => $video)
	                  <tr>
	                    <td><b>{{$video->content_id}}</b></td>
	                    <td>{{$video->category->cat_name}}</td>
                      <td>{{$video->content_title}}</td>
	                    <td>{{$video->content_title_bn}}</td>
	                    <td>{{$video->content_type}}</td>
                      <td align="center" class="text-center">

                        <a title="View Video" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                        <!-- <video id="onplayvideo_{{$video->id}}" class="videoFiles">
                          <source src='{{asset("uploads/contents/video/$video->file_name")}}' type="video/mpeg"> 
                        </audio>
                        <a onclick="playAudio({{$video->id}})" class="audioPlay"><i class="fas fa-play"></i></a> -->
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5>{{$video->content_title_bn}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <video width="400" controls>
                                  <source src='{{asset("uploads/contents/video/$video->file_name")}}' type="video/mp4">
                                  
                                </video>
                              </div>
                              
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      </td>
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('video-contents.edit'))
                            <a href="{{route('video-contents.edit', $video->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('video-contents.destroy'))
                            <a onclick="confirm_modal('{{route('video-contents.destroy', $video->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
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
    
    $('#videoContentTable').DataTable({
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


</script>
@endsection