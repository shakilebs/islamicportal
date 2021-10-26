@extends('layouts.admin_master')
@section('title','Wallpaper Content | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Wallpaper Content</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Wallpaper Content</li>
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
                <h5 class="card-title">Wallpaper Content</h5>
                <div class="card-tools">

                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('wallpaper-contents.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("wallpaper-contents.create")}}'>Add Content</a>
                   @endif 
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="contentTable" class="table table-bordered table-hover">
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
                  	@forelse($contentList as $key => $content)
	                  <tr>
	                    <td><b>{{$content->content_id}}</b></td>
	                    <td>{{$content->category->cat_name}}</td>
                      <td>{{$content->content_title}}</td>
	                    <td>{{$content->content_title_bn}}</td>
	                    <td>{{$content->content_type}}</td>
                      <td align="center" class="text-center">
                       <img src='{{asset("uploads/contents/wallpapers/$content->file_name")}}' class="img-responsive" height="120px" width="200px"> 
                      </td>
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('wallpaper-contents.create'))
                            <a href="{{route('wallpaper-contents.edit', $content->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('wallpaper-contents.create'))
                            <a onclick="confirm_modal('{{route('wallpaper-contents.destroy', $content->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
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
    
    $('#contentTable').DataTable({
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