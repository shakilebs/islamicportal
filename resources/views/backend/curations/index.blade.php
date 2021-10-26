@extends('layouts.admin_master')
@section('title','Curation List| Islamic Portal')
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
            <h4>Curation List</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Curation List</li>
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
                <h5 class="card-title">Curation List</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                  @if(Auth::user()->can('curations.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='#' data-toggle="modal" data-target="#curationModalAdd">Add Curations</a>
                   @endif

                    <!-- Permission Add Modal -->

                    <div class="modal fade" id="curationModalAdd">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Curations</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <form id="addCuration" class="form-horizontal" action="{{ route('curations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="name_add">Name</label>
                                    <input type="text" name="name" class="form-control" id="name_add" placeholder="curate name" required="required">
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="name_bn_add">Name BN</label>
                                    <input type="text" name="name_bn" class="form-control" id="name_bn_add" placeholder="curate name in BN" required="required">
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="cat_name">Select Category</label>
                                    <select class="form-control select2" name="cat_id" style="width: 100%;" required>
                                      <option>Select</option>
                                      @foreach($categoryList as $category)
                                      <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="cat_name">Select Service</label>
                                    <select class="form-control" name="service_id" style="width: 100%;" required>
                                      <option value="">Select</option>
                                      @foreach($serviceList as $service)
                                      <option value="{{$service->id}}">{{$service->service_name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="item_limit_add">Item Limit</label>
                                    <input type="number" name="item_limit" class="form-control" id="item_limit_add" placeholder="">
                                  </div>
                                  
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                      <option value="1">Enable</option>
                                      <option value="2">Disable</option>
                                    </select>
                                  </div>
                                  
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="sort_order_add">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" id="sort_order_add" placeholder="" required>
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
              <div class="card-body" id="curation_data_table">
                <table id="curationTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sort Order</th>
                    <th>Name</th>
                    <th>Name BN</th>
                    <th>Category</th>
                    <th>Service Name</th>
                    <th>Limit</th>
                    <th>Show App</th>
                    <th>Show Web</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="draggableRow">
                  	@forelse($curationsList as $key => $curation)
	                  <tr data-id="{{$curation->id}}" class="sortable">
	                    <td class="position">{{$curation->sort_order}}</td>
                      <td class="curate-name">{{$curation->name}}</td>
                      <td>{{$curation->name_bn}}</td>
                      <td>{{$curation->category->cat_name}}</td>
                      <td>{{$curation->serviceName->service_name}}</td>
                      <td>{{$curation->item_limit}}</td>
                      <td>
                        <label class="switch">
                            <input onchange="update_status(this)" value="{{ $curation->id }}" type="checkbox" name="show_app" {{($curation->show_app==1)?'checked':''}} >
                            <span class="slider round"></span></label>

                      
                      </td>
                      <td>
                        <label class="switch">
                            <input onchange="update_status(this)" value="{{ $curation->id }}" type="checkbox" name="show_web" {{($curation->show_web==1)?'checked':''}} >
                            <span class="slider round"></span></label>

                      
                      </td>
                      <td>
                        <label class="switch">
                            <input onchange="update_status(this)" value="{{ $curation->id }}" type="checkbox" name="status" {{($curation->status==1)?'checked':''}} >
                            <span class="slider round"></span></label>

                      
                      </td>
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('curations.edit'))
                            <a href="#" data-toggle="modal" data-target="#curationsModalEdit{{$curation->id}}" class="btn btn-info btn-xs" ><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('curations.destroy'))
                            <a onclick="confirm_modal('{{route('curations.destroy', $curation->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                            @endif
                          </div>
                        </div> 
                        
                      </td>
	                  </tr>

                    <!-- Permission Edit Modal -->
                        <div class="modal fade" id="curationsModalEdit{{$curation->id}}">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Curations</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                <form id="EditPermission_{{$curation->id}}" class="form-horizontal" action="{{ route('curations.update',$curation->id) }}" method="POST" enctype="multipart/form-data">
                                  <input name="_method" type="hidden" value="PATCH">  
                                @csrf
                                <div class="modal-body">
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="curate name" value="{{$curation->name}}" required="required">
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="name_bn">Name BN</label>
                                    <input type="text" name="name_bn" class="form-control" placeholder="curate name in BN" required="required" value="{{$curation->name_bn}}" >
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="cat_name">Select Category</label>
                                    <select class="form-control select2" name="cat_id" style="width: 100%;" required>
                                      <option>Select</option>
                                      @foreach($categoryList as $category)
                                      <option value="{{$category->id}}" {{($curation->cat_id==$category->id)?'selected':''}}>{{$category->cat_name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="cat_name">Select Service</label>
                                    <select class="form-control" name="service_id" style="width: 100%;" required>
                                      <option value="">Select</option>
                                      @foreach($serviceList as $service)
                                      <option value="{{$service->id}}" {{($curation->service_id==$service->id)?'selected':''}}>{{$service->service_name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="item_limit">Item Limit</label>
                                    <input type="number" name="item_limit" class="form-control" placeholder="" value="{{$curation->item_limit}}">
                                  </div>
                                  
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                      <option value="1" {{($curation->status==1)?'selected':''}}>Enable</option>
                                      <option value="2" {{($curation->status==2)?'selected':''}}>Disable</option>
                                    </select>
                                  </div>
                                  
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control"  placeholder="" required value="{{$curation->sort_order}}">
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
	                @empty
	                <tr class="empty-message">
	                	<td colspan="10" align="center"><h4>No Item found! <i class="far fa-frown"></i></h4></td>
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
  var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
  $(function () {
    $('.select2').select2()
    $('#curationTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "info": true,
      "responsive": true,
      "rowReorder": true,
    });
    $('#addCuration').validate({
      rules: {
        name: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "Please enter a name",
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
  function update_status(el){
    
    var el_name = el.name;
    
      if(el_name=='show_app'){
       if(el.checked){
          var el_status = 1;

        }
        else{
            var el_status = 0;
        } 
      }
      if(el_name=='show_web'){
       if(el.checked){
          var el_status = 1;

        }
        else{
            var el_status = 0;
        } 
      }
      if(el_name=='status'){
       if(el.checked){
          var el_status = 1;

        }
        else{
            var el_status = 2;
        } 
      }
      //--------------Status Updates via Ajax----------------------- 
      $.post('{{ route('curations.statusUpdate') }}', {_token:'{{ csrf_token() }}', id:el.value, el_status:el_status,el_name:el_name}, function(data){
          if(data == 1){
              Toast.fire({
                icon: 'success',
                title: 'Curations updated successfully'
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


  // ---------------------Datatable Reorder Sorting -----------------------
  function sendReorderRequest($sort_id) {
        
        var items = $sort_id.sortable('toArray', {attribute: 'data-id'});
        var ids = $.grep(items, (item) => item !== "");

        if ($sort_id.find('tr.sortable').length) {
            $sort_id.find('.empty-message').hide();
        }
        
        
        $.post('{{ route('curations.rowreorder') }}', {_token:'{{ csrf_token() }}', ids,
                curate_id: $sort_id.data('id')}, function(data){  
          if(data.response.success){
            $sort_id.children('tr.sortable').each(function (index, curate) {

                    $(curate).children('.position').text(data.response.positions[$(curate).data('id')])
                });
              Toast.fire({
                icon: 'success',
                title: data.response.success
              })
          }
          else{
              Toast.fire({
                icon: 'error',
                title: data.response.error
              })
          }
      });
        
        
    }
  $(document).ready(function () {
        var $curations = $('#draggableRow');
        $curations.sortable({
            connectWith: '.sortable',
            items: 'tr.sortable',
            stop: (event, ui) => {
                sendReorderRequest($(ui.item).parent());

                if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                    if ($(event.target).find('tr.sortable').length) {
                        sendReorderRequest($(event.target));
                    } else {
                        $(event.target).find('.empty-message').show();
                    }
                }
            }
        });
        $('#draggableRow').disableSelection();
    });
</script>
@endsection