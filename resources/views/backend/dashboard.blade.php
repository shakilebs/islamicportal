@extends('layouts.admin_master')
@section('title','Islamic Portal Dashboard')
@section('content')

<style type="text/css">
  .todayDate{
    background-color: #e11010;
    padding: 2px;
    margin: 10px 0px; 
    border-radius: 5px;
    text-align: center;
    color: #fff;
  }
  .col-2-halfoffset{
    -webkit-flex: 0 0 20% !important;
    -ms-flex: 0 0 20% !important;
    flex: 0 0 20% !important;
    max-width: 20% !important;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$totalCategory}}</h3>

                <p>Category</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-alt"></i>
              </div>
              <a href="{{route('categories.index')}}" class="small-box-footer">
                Category List <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$audioContent}}</h3>

                <p>Audio Content</p>
              </div>
              <div class="icon">
                <i class="far fa-file-audio"></i>
              </div>
              <a href="{{route('audio-contents.index')}}" class="small-box-footer">
                Audio List <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$videoContent}}</h3>

                <p>Video Content</p>
              </div>
              <div class="icon">
                <i class="fas fa-video"></i>
              </div>
              <a href="{{route('video-contents.index')}}" class="small-box-footer">
                Video List <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$wallpaperContent}}</h3>

                <p>Wallpaper</p>
              </div>
              <div class="icon">
                <i class="fas fa-images"></i>
              </div>
              <a href="{{route('wallpaper-contents.index')}}" class="small-box-footer">
                Wallpaper list <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3>{{$nameOfAllah}}</h3>

                <p>Allah Names</p>
              </div>
              <div class="icon">
                <i class="fas fa-mosque"></i>
              </div>
              <a href="{{route('allah-name.index')}}" class="small-box-footer">
                Name List <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small card -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>{{$textContent}}</h3>

                <p>Text Content</p>
              </div>
              <div class="icon">
                <i class="fas fa-text-width"></i>
              </div>
              <a href="{{route('text-contents.index')}}" class="small-box-footer">
                Text List <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="todayDate">
              <h4>Today is: {{$todaySalatTime->day_name}}, {{date('d',strtotime($todaySalatTime->date))}}th of {{date('F',strtotime($todaySalatTime->date))}} {{date('Y',strtotime($todaySalatTime->date))}}</h4>
            </div>
          </div>
          @php 
            $getLocalTime = date('h:i A', strtotime(Carbon\Carbon::now()));
             
          @endphp
        </div>
        <div class="row">
          <div class="col-12">
            <h4 class="text-center">Today Salat Time</h4>

          </div>
          <div class="col-2-halfoffset col-6">
            <!-- small card -->
            <div class="small-box   bg-gray">
              <div class="inner">
                <h4>{{str_replace('-',':',$todaySalatTime->fajr)}} AM</h4>

                <p>Fajr</p>
              </div>
              
            </div>
          </div>
         <div class="col-2-halfoffset col-6">
            <!-- small card -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h4>{{str_replace('-',':',$todaySalatTime->dhuhr)}} PM</h4>

                <p>Dhuhr  </p>
              </div>
              
            </div>
          </div>
         <div class="col-2-halfoffset col-6">
            <!-- small card -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h4>{{str_replace('-',':',$todaySalatTime->asr)}} PM</h4>

                <p>Asr</p>
              </div>
              
            </div>
          </div>
         <div class="col-2-halfoffset col-6">
            <!-- small card -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h4>{{str_replace('-',':',$todaySalatTime->maghrib)}} PM</h4>

                <p>Maghrib</p>
              </div>
              
            </div>
          </div>
         <div class="col-2-halfoffset col-6">
            <!-- small card -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h4>{{str_replace('-',':',$todaySalatTime->isha)}} PM</h4>

                <p>Isha</p>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">This Week Salat & Iftar time</h5>
                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="salatTable" class="table table-bordered table-hover" style="width:100%">
                  <thead>
                  <tr>
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
                  </tr>
                  </thead>
                  <tbody>
                    @forelse($weeklySalatTime as $key => $time)
                    
                    <tr style="{{($time->date == date('Y-m-d'))?'background-color: #099344;color: #fff;':''}}">
                      
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
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th>Name</th>
                    <th>Name BN</th>
                    <th>Content Type</th>
                    <th>Icon</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse($latestCategory as $category)
                    <tr>
                      <td>{{$category->cat_name}}</td>
                      <td>{{$category->cat_name_bn}}</td>
                      <td>{{$category->content_type}}</td>
                      
                      <td>
                        <img src='{{asset("uploads/category/icons/$category->icon")}}' class="img-responsive img-thumnailed" height="40px" width="40px">
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4">No category found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="float-right">
                  <a href="{{route('categories.index')}}" class="btn btn-default btn-sm btn-hover"> View More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                
              </div>
              <!-- /.footer -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Audio</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th>Content ID</th>
                    <th>Category Name</th>
                    <th>Title</th>
                    <th>Audio</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse($latestAudio as $key => $audio)
                    <tr>
                      <td><b>{{$audio->content_id}}</b></td>
                      <td>{{$audio->category->cat_name}}</td>
                      <td>{{$audio->content_title}}</td>
                      
                      <td align="center" class="text-center">
                        <audio id="onplayAudio_{{$audio->id}}" class="audioFiles">
                          <source src='{{asset("uploads/contents/audio/$audio->file_name")}}' type="audio/mpeg"> 
                        </audio>
                        <a onclick="playAudio({{$audio->id}})" class="audioPlay"><i class="fas fa-play" style="color:#ff0000"></i></a>
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
              <div class="card-footer clearfix">
                <div class="float-right">
                  <a href="{{route('audio-contents.index')}}" class="btn btn-default btn-sm btn-hover"> View More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                
              </div>
              <!-- /.card-body -->
              
              <!-- /.footer -->
            </div>
          </div>
          
        </div>
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
@endsection
@section('scripts')
<script type="text/javascript">
  function playAudio(id){
    var audioFile = document.getElementById("onplayAudio_"+id);
    console.log(audioFile);
    
    return audioFile.paused ? audioFile.play() : audioFile.pause();
  }
</script>
@endsection