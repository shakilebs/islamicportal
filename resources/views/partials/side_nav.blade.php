<!-- Main Sidebar Container -->
@php
$getRouteName = Route::currentRouteName();

@endphp

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
      <img src="{{asset('uploads/bg/portal-logo.jpg')}}" alt="Islamic Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Islamic Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::User()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{url('/admin/dashboard')}}" class="nav-link {{($getRouteName == 'dashboard')?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
          @if(Auth::guard('web')->user()->can('categories.index'))
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link {{($getRouteName == 'categories.create' || $getRouteName == 'categories.index')?'active':''}}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Manage Category
              </p>
            </a>

          </li>
          @endif
          @if(Auth::guard('web')->user()->can('audio-contents.index'))
          <li class="nav-item">
            <a href="{{route('audio-contents.index')}}" class="nav-link {{($getRouteName=='audio-contents.create' || $getRouteName=='audio-contents.index')?'active':''}} ">
              <i class="far fa-file-audio nav-icon"></i>
              <p>Audio Contents</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('video-contents.index'))
          <li class="nav-item">
            <a href="{{route('video-contents.index')}}" class="nav-link {{($getRouteName=='video-contents.index' || $getRouteName=='video-contents.create')?'active':''}}">
              <i class="fas fa-video nav-icon"></i>
              <p>Video Contents</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('wallpaper-contents.index'))
          <li class="nav-item">
            <a href="{{route('wallpaper-contents.index')}}" class="nav-link {{($getRouteName=='wallpaper-contents.index' || $getRouteName=='wallpaper-contents.create')?'active':''}}">
              <i class="fas fa-images nav-icon"></i>
              <p>Wallpaper Contents</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('text-contents.index'))
          <li class="nav-item">
            <a href="{{route('text-contents.index')}}" class="nav-link {{($getRouteName=='text-contents.index' || $getRouteName=='text-contents.create')?'active':''}}">
              <i class="nav-icon fas fa-text-width"></i>
              <p>Text Contents</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('allah-name.index'))
          <li class="nav-item">
            <a href="{{route('allah-name.index')}}" class="nav-link {{($getRouteName == 'allah-name.create' || $getRouteName == 'allah-name.index')?'active':''}}">
              <i class="nav-icon fas fa-mosque"></i>
              <p>99 Allah Names</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('subscriptions.index'))
          <li class="nav-item ">
            <a href="{{route('subscriptions.index')}}" class="nav-link {{($getRouteName == 'subscriptions.index' || $getRouteName == 'subscriptions.create')?'active':''}}">
              <i class="nav-icon fas fa-hand-pointer"></i>
              <p>
                Subscription List
               
              </p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('common-page.index'))
          <li class="nav-item ">
            <a href="{{route('common-page.index')}}" class="nav-link {{($getRouteName == 'common-page.index' || $getRouteName == 'common-page.create')?'active':''}}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Common Pages
               
              </p>
            </a>
          </li>
          @endif
          @if(Auth::guard('web')->user()->can('prayer-times.index'))
          <li class="nav-item ">
            <a href="{{route('prayer-times.index')}}" class="nav-link {{($getRouteName == 'prayer-times.index' || $getRouteName == 'prayer-times.create')?'active':''}}">
              <i class="nav-icon fas fa-pray"></i>
              <p>
                Salat & Ramadan Times
               
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item ">
            <a href="{{route('curations.index')}}" class="nav-link {{($getRouteName == 'curations.index' || $getRouteName == 'curations.create')?'active':''}}">
              <i class="fas fa-bezier-curve"></i>
              <p>
                Curation
               
              </p>
            </a>
          </li>
          <!-- @if(Auth::guard('web')->user()->can('curations.index')) -->
          
          <!-- @endif -->
          
          @if(Auth::guard('web')->user()->can('permissions.index') || Auth::guard('web')->user()->can('roles.index') || Auth::guard('web')->user()->can('users.index'))
          <li class="nav-item {{($getRouteName == 'permissions.index' || $getRouteName == 'roles.index' || $getRouteName == 'roles.create' || $getRouteName == 'users.index' || $getRouteName == 'users.create')?'menu-open':''}}">
            <a href="#" class="nav-link {{($getRouteName == 'permissions.index' || $getRouteName == 'roles.index' || $getRouteName == 'roles.create' || $getRouteName == 'users.index' || $getRouteName == 'users.create')?'active':''}}">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Manage Permission
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link {{($getRouteName == 'permissions.index')?'active':''}}">
                  <i class="fas fa-lock nav-icon"></i>
                  <p>Permission List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link {{($getRouteName == 'roles.index' || $getRouteName == 'roles.create')?'active':''}}">
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Role List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link {{($getRouteName == 'users.index' || $getRouteName == 'users.create')?'active':''}}">
                  <i class="far fa-user nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>