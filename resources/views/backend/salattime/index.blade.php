@extends('layouts.admin_master')
@section('title','Salat & Ramadan Time | Islamic Portal')
@section('content')

<style type="text/css">
  #salatTable {
        width: 800px;
        margin: 0 auto;
    }
</style>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Salat & Ramadan Time</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Salat & Ramadan Time</li>
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
                <h5 class="card-title">Salat & Ramadan Time</h5>
                <div class="card-tools">
                	<div class="d-flex justify-content-end">
                    @if(Auth::user()->can('prayer-times.create'))
                	<a class="btn btn-block bg-gradient-info btn-sm" href='{{route("prayer-times.create")}}'>Add Time Here</a>
                    @endif
                </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="salatTable" class="table table-bordered table-hover" style="width:100%">
                  <thead>
                  <tr>
                    <th>Year</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Day Bn</th>
                    <th>Seheri</th>
                    <th>Iftar</th>
                    <th>Fajr</th>
                    <th>Dhuhr</th>
                    <th>Asr</th>
                    <th>Maghrib</th>
                    <th>Isha</th>
                    <th>Sunset</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@forelse($salatTimeList as $key => $time)
	                  <tr>
	                    <td>{{$time->year}}</td>
	                    <td><b>{{date('d/m/Y',strtotime($time->date))}}</b></td>
                      <td>{{$time->day_name}}</td>
                      <td>{{$time->day_name_bn}}</td>
                      <td>{{str_replace('-',':',$time->seheri)}} AM</td>
                      <td>{{str_replace('-',':',$time->iftar)}} PM</td>
                      <td>{{str_replace('-',':',$time->fajr)}} AM</td>
                      <td>{{str_replace('-',':',$time->dhuhr)}} PM</td>
                      <td>{{str_replace('-',':',$time->asr)}} PM</td>
                      <td>{{str_replace('-',':',$time->maghrib)}} PM</td>
                      <td>{{str_replace('-',':',$time->isha)}} PM</td>
                      <td>{{str_replace('-',':',$time->sunset)}} PM</td>
                      <td>{{$time->userName->name }}</td>
                      
                      
	                    <td>
                        <div class="form-inline">
                          <div class="input-group">
                            @if(Auth::user()->can('prayer-times.edit'))
                            <a href="{{route('prayer-times.edit', $time->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> &nbsp;
                            @endif
                          </div>
                          <div class="input-group">
                            @if(Auth::user()->can('prayer-times.destroy'))
                            <a onclick="confirm_modal('{{route('prayer-times.destroy', $time->id)}}');" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
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
    
    $('#salatTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "scrollX": true
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