@extends('layouts.admin_master')
@section('title','Subscription List | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Subscription Add</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Subscription Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-square"></i> Subscription Add Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addSubscription" class="form-horizontal" action="{{ route('subscriptions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-4">
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
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" id="sort_order">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sub_pack">Sub Pack</label>
                        <input type="text" name="sub_pack" class="form-control" id="sub_pack" placeholder="Enter sub pack">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sub_pack_name">Sub Pack Name</label>
                        <input type="text" name="sub_pack_name" class="form-control" id="sub_pack_name" placeholder="Enter sub pack name">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="pack_name">Pack Name</label>
                        <input type="text" name="pack_name" class="form-control" id="pack_name" placeholder="Pack Name">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="pack_duration">Pack Duration</label>
                        <input type="text" name="pack_duration" class="form-control" id="pack_duration" placeholder="Pack duration">
                      </div>
                    </div>


                    <div class="col-6">
                      <div class="form-group">
                        <label for="sub_details">Sub Details</label>
                        <textarea name="sub_details" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="reg_msg">Registration Msg</label>
                        <textarea name="reg_msg" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="sub_text">Sub Text</label>
                        <input type="text" name="sub_text" class="form-control" id="sub_text" placeholder="sub text">
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
                    <div class="col-4">
                      <div class="form-group">
                        <label for="special_offer">Special Offer</label>
                        <select class="form-control" name="special_offer">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="is_free">Is Free?</label>
                        <select class="form-control" name="is_free">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="is_sep">Is Sep?</label>
                        <select class="form-control" name="is_sep">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-success btn-sm btn-right">Submit</button>
                  <a href="{{route('subscriptions.index')}}" class="btn btn-danger btn-sm btn-right">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script>
  $(function () {
  $('.select2').select2();
  
  $('#addSubscription').validate({
    rules: {
      service_id: {
        required: true,
      },
      sort_order: {
        required: true,
      },
      pack_name: {
        required: true
      },
      sub_pack: {
        required: true
      },
      pack_duration: {
        required: true
      },
      sub_details: {
        required: true
      },
      reg_msg: {
        required: true
      },
      
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

</script>
@endsection