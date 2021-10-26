@extends('layouts.admin_master')
@section('title','Category List | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Category List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Category List</li>
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
                <h5 class="card-title">Category List</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('categories.create'))
                	 <a class="btn btn-block bg-gradient-info btn-sm" href='{{route("categories.create")}}'>Add Category</a>
                    @endif
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categoryTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Name BN</th>
                    <th>Category Code</th>
                    <th>Content Type</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($categoryList as $key => $category)
	                  <tr>
	                    <td>{{$category->cat_name}}</td>
	                    <td>{{$category->cat_name_bn}}</td>
	                    <td>{{$category->cat_code}}</td>
	                    <td>{{$category->content_type}}</td>
                      <td>
                        <img src='{{asset("uploads/category/icons/$category->icon")}}' class="img-responsive img-thumnailed" height="70px" width="70px">
                      </td>
                      <td>
                        <label class="switch">
                            <input onchange="update_status(this)" value="{{ $category->id }}" type="checkbox" {{($category->status==1)?'checked':''}} >
                            <span class="slider round"></span></label>

                      </td>
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('categories.edit'))
                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('categories.destroy'))
                            <a onclick="confirm_modal('{{route('categories.destroy', $category->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                      </td>
	                  </tr>
	                @empty
	                <tr>
	                	<td colspan="6" align="center"><h4>No Category found! <i class="far fa-frown"></i></h4></td>
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
    
    $('#categoryTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    
  });
 
  
  function update_status(el){
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      if(el.checked){
          var status = 1;
      }
      else{
          var status = 0;
      }
      $.post('{{ route('categories.statusUpdate') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
              Toast.fire({
                icon: 'success',
                title: 'Category status updated successfully'
              })
          }
          else{
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong'
              })
          }
      });
  }

</script>
@endsection