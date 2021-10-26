@extends('layouts.admin_master')
@section('title','Text Content | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Text Content</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Text Content</li>
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
                <h5 class="card-title">Text Content</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('text-contents.create'))
                	 <a class="btn btn-block bg-gradient-info btn-sm" href='{{route("text-contents.create")}}'>Add Content</a>
                    @endif 
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="contentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Content Title</th>
                    <th>Title BN</th>
                    <th>Content Details</th>
                    <th>Content Type</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($textContentList as $key => $content)
	                  <tr>
	                    <td>{{$content->category->cat_name}}</td>
                      <td>{{$content->content_title}}</td>
	                    <td>{{$content->content_title_bn}}</td>
                      <td><a href="#" title="View Details" data-toggle="modal" data-target="#modal-default">{!! substr($content->content_details,0,600)!!}</a>  
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5>{{$content->content_title_bn}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="max-height: 700px;overflow: scroll;">
                                <div class="row">
                                  {!! $content->content_details !!}
                                </div>
                              </div>
                              
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      </td>
	                    <td>{{$content->content_type}}</td>

	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('text-contents.edit'))
                            <a href="{{route('text-contents.edit', $content->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('text-contents.destroy'))
                            <a onclick="confirm_modal('{{route('text-contents.destroy', $content->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
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