@extends('layouts.admin_master')
@section('title','Subscription List | Islamic Portal')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Subscription Edit</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Subscription Edit</li>
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
                <h3 class="card-title"><i class="fas fa-edit"></i> Subscription Edit Here</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addSubscription" class="form-horizontal" action="{{ route('subscriptions.update',$subscription->id) }}" method="POST" enctype="multipart/form-data">
              	<input name="_method" type="hidden" value="PATCH">  
                @csrf
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-4">
                      <div class="form-group">
                        <label for="cat_name">Select Service</label>
                        <select class="form-control" name="service_id" style="width: 100%;" required>
                          <option value="">Select</option>
                          @foreach($serviceList as $service)
                          <option value="{{$service->id}}" {{($service->id==$subscription->service_id)?'selected':''}}>{{$service->service_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" id="sort_order" value="{{$subscription->sort_order}}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sub_pack">Sub Pack</label>
                        <input type="text" name="sub_pack" class="form-control" id="sub_pack" placeholder="Enter sub pack" value="{{$subscription->sub_pack}}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sub_pack_name">Sub Pack Name</label>
                        <input type="text" name="sub_pack_name" class="form-control" id="sub_pack_name" placeholder="Enter sub pack name" value="{{$subscription->sub_pack_name}}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="pack_name">Pack Name</label>
                        <input type="text" name="pack_name" class="form-control" id="pack_name" placeholder="Pack Name" value="{{$subscription->pack_name}}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="pack_duration">Pack Duration</label>
                        <input type="text" name="pack_duration" class="form-control" id="pack_duration" placeholder="Pack duration" value="{{$subscription->pack_duration}}">
                      </div>
                    </div>


                    <div class="col-6">
                      <div class="form-group">
                        <label for="sub_details">Sub Details</label>
                        <textarea name="sub_details" class="form-control">{{$subscription->sub_details}}</textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="reg_msg">Registration Msg</label>
                        <textarea name="reg_msg" class="form-control">{{$subscription->reg_msg}}</textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="sub_text">Sub Text</label>
                        <input type="text" name="sub_text" class="form-control" id="sub_text" placeholder="sub text" value="{{$subscription->sub_text}}">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                          <option value="1" {{($subscription->status == 1)?'selected':''}}>Enable</option>
                          <option value="2" {{($subscription->status == 2)?'selected':''}}>Disable</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="special_offer">Special Offer</label>
                        <select class="form-control" name="special_offer">
                          <option value="0" {{($subscription->special_offer == 0)?'selected':''}}>No</option>
                          <option value="1" {{($subscription->special_offer == 1)?'selected':''}}>Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="is_free">Is Free?</label>
                        <select class="form-control" name="is_free">
                          <option value="0" {{($subscription->is_free == 0)?'selected':''}}>No</option>
                          <option value="1" {{($subscription->is_free == 1)?'selected':''}}>Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="is_sep">Is Sep?</label>
                        <select class="form-control" name="is_sep">
                          <option value="0" {{($subscription->is_sep == 0)?'selected':''}}>No</option>
                          <option value="1" {{($subscription->is_sep == 1)?'selected':''}}>Yes</option>
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