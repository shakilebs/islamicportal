@extends('layouts.admin_master')
@section('title','Common Pages | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Common Pages</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Common Pages</li>
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
                <h5 class="card-title">Common Pages</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('common-page.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("common-page.create")}}'>Add Page</a>
                   @endif 
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="contentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Page Title</th>
                    <th>Page Content</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($pageList as $key => $page)
	                  <tr>
	                    <td>{{$page->page_name}}</td>
                      <td><a href="#" title="View Details" data-toggle="modal" data-target="#modal-default">{!! substr($page->page_content,0,600)!!}</a>  
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5>{{$page->page_name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="max-height: 700px;overflow: scroll;">
                                <div class="row">
                                  {!! $page->page_content !!}
                                </div>
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
                            @if(Auth::user()->can('common-page.edit'))
                            <a href="{{route('common-page.edit', $page->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('common-page.destroy'))
                            <a onclick="confirm_modal('{{route('common-page.destroy', $page->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                      </td>
	                  </tr>
	                @empty
	                <tr>
	                	<td colspan="6" align="center"><h4>No page found! <i class="far fa-frown"></i></h4></td>
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

@endsection