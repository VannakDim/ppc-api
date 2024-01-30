@php($user = Auth::user())
<!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        @if(!empty(Auth::user()->image))
        <img src="{{ $user->image }}" class="img-circle" alt="{{ Auth::user()->name }}">
        @else
        <img src="{{ asset('avatar/user.png') }}" class="img-circle" alt="{{ Auth::user()->name }}">
        @endif
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <div id="mainMenu">
      <ul class="sidebar-menu" data-widget="tree">
      
        <li><a href="#"><i class="fa fa-home text-purple"></i> <span>Dashboard</span></a></li>
        <li><a href=""><i class="fa fa-paper-plane text-purple"></i> <span>Category</span></a></li>
        <li><a href=""><i class="fa fa-tag text-purple"></i> <span>Tag</span></a></li>
        <li><a href=""><i class="fa fa-newspaper-o text-purple"></i> <span>Post</span></a></li>
        <li><a href=""><i class="fa fa-users text-purple"></i> <span>User</span></a></li>
        <li><a href=""><i class="fa fa-user text-purple"></i> <span>Member</span></a></li>
        <li><a href=""><i class="fa fa-cloud-download text-purple" aria-hidden="true"></i> <span>Free Resource</span></a></li>
        <li><a href=""><i class="fa fa-comment text-purple"></i> <span>Comment</span></a></li>
        <li><a href=""><i class="fa fa-envelope text-purple"></i> <span>Subscriber</span></a></li>
        <li><a href=""><i class="fa fa-file text-purple"></i> <span>Page</span></a></li>
        <li><a href=""><i class="fa fa-image text-purple"></i> <span>Gallery</span></a></li>
        <li><a href=""><i class="fa fa-image text-purple"></i> <span>Advertisement</span></a></li>
        <li><a href=""><i class="fa fa-image text-purple"></i> <span>Banner</span></a></li>
        <li><a href=""><i class="fa fa-gears text-purple"></i> <span>Setting</span></a></li>
        <li class="header">LABELS</li>
        <li><a href=""><i class="fa fa-user text-purple"></i> <span>Profile</span></a></li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock text-purple"></i>Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </div>
  </section>
    <!-- /.sidebar -->