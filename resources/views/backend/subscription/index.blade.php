@extends('layouts.admin_master')
@section('title','Subscription List | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Subscription List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Subscription List</li>
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
                <h5 class="card-title">Subscription List</h5>
                <div class="card-tools">
                  <div class="d-flex justify-content-end">
                    @if(Auth::user()->can('subscriptions.create'))
                  <a class="btn btn-block bg-gradient-info btn-sm" href='{{route("subscriptions.create")}}'>Add Subscription</a>
                    @endif
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="contentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sort Order</th>
                    <th>Service Name</th>
                    <th>Pack Name</th>
                    <th>Pack Duration</th>
                    <th>Details</th>
                    <th>Registration Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($subscriptionList as $key => $subscribe)
	                  <tr>
	                    <td><b>{{$subscribe->sort_order}}</b></td>
                      <td>{{$subscribe->serviceName->service_name}}</td>
	                    <td>{{$subscribe->pack_duration}}</td>
	                    <td>{{$subscribe->pack_name}}</td>
	                    <td>{{$subscribe->sub_details}}</td>
	                    <td>{{$subscribe->reg_msg}}</td>
	                    <td>
                        	<label class="switch">
                            <input onchange="update_status(this)" value="{{ $subscribe->id }}" type="checkbox" {{($subscribe->status==1)?'checked':''}} >
                            <span class="slider round"></span></label>

                      </td>
                      <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('subscriptions.create'))
                            <a href="{{route('subscriptions.edit', $subscribe->id)}}" class="btn btn-info btn-xs" style="margin-bottom: 2px;"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('subscriptions.create'))
                            <a onclick="confirm_modal('{{route('subscriptions.destroy', $subscribe->id)}}');" class="btn btn-danger btn-xs" style="margin-bottom: 2px;"><i class="fas fa-trash"></i></a>
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
    
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
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
      $.post('{{ route('subscriptions.statusUpdate') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            
              Toast.fire({
                icon: 'success',
                title: 'Subscription status updated successfully'
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