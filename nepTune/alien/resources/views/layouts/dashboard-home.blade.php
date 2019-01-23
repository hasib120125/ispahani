<!DOCTYPE html>
<html>
<head>
  <title>Admin Dash Board</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href='{{ url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css")}}'>
    <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css")}}'>
    <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css")}}'>
    <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css")}}'>
    <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/skin-blue.min.css")}}'>
    <script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js") }}'></script>
    <link rel="stylesheet" href='{{ asset("css/dupl-style.css")}}'>

    <script src={{ 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js' }}></script>
    <script src={{ 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js' }}></script>
</head>
<body class="hold-transition skin-blue sidebar-mini skin-green">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dash</b>Board</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Institute Name</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              {{ Auth::user()->institute_name }}
            </a>
          </li>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have no messages</li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>

          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">1</span>
            </a>

          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src={{ asset('media/icon/user-profile.png')}} class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src={{ asset('media/icon/user-profile.png')}} class="img-circle" alt="User Image">

                <p>{{ Auth::user()->name }}</p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <!-- <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a> -->
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src={{ asset('media/icon/user-profile.png')}} class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- NAV LEFT sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Users Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('user-registration')}}"><i class="fa fa-circle-o"></i> Create User</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Users Permission</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Academic Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('applicants-report')}}"><i class="fa fa-circle-o"></i> Institute Setings</a></li>
            <li><a href="{{ url('academic-information') }}"><i class="fa fa-circle-o"></i> Academic Setings</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Teacher & Staff Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('staff-department') }}"><i class="fa fa-circle-o"></i> Staff Department</a></li>
            <li><a href="{{ url('teacher-staff') }}"><i class="fa fa-circle-o"></i> Create Teacher & Staff </a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Governing Body</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Content Create & Update</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('contents-category')}}"><i class="fa fa-circle-o"></i> Content Category</a></li>
            <li><a href="{{url('contents-information')}}"><i class="fa fa-circle-o"></i> Content Information</a></li>
            <li><a href="{{url('messages')}}"><i class="fa fa-circle-o"></i> All Messages</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i> <span>Institute Notice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('notice-category')}}"><i class="fa fa-circle-o"></i> Notice Category</a></li>
            <li><a href="{{url('notice-information')}}"><i class="fa fa-circle-o"></i> Notice Information</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-image-o"></i> <span>Photo & Video Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('album-category')}}"><i class="fa fa-circle-o"></i> Album Category</a></li>
            <li><a href="{{url('album-group')}}"><i class="fa fa-circle-o"></i> Album Group</a></li>
            <li><a href="{{url('album-image')}}"><i class="fa fa-circle-o"></i> Album Image</a></li>
            <li><a href="{{url('video-gallery')}}"><i class="fa fa-circle-o"></i> Video Upload</a></li>
            <li><a href="{{url('others-image')}}"><i class="fa fa-circle-o"></i> Manual Image Upload</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-powerpoint-o"></i> <span>Digital Content</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Content Catagory</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Content Upload</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bold"></i> <span>Blog & Magazine</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Blog Category</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Blog Subcategory</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Blog Information</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i> <span>Quiz Registration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Applicant Info</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Settings</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Student Reunion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Ex-students</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Reunion Setting</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Reunion Application</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Payment Information</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Send Email</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Send List</a></li>
          </ul>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home"></i>
        <small>@yield('title')</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

           <div class="row">
               <!-- Your Page Content Here -->
               @yield('content')
           </div>

        </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="http://www.deshuniversal.com" target="_blank">Desh Universal Privet Limited</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="container" >
      <h3 class="control-sidebar-heading">General Settings</h3>
      <ul class="list-unstyled">
        <li><a href="{{ url('institute-password-change') }}"><i class="fa fa-circle-o text-red"></i> <span>Password Change</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Profile Update</span></a></li>
        <li><i class="fa fa-circle-o text-aqua"></i>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </div>
  </aside>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js") }}'></script>
<script src='{{ url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js") }}'></script>
<script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js") }}'></script>
<script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/pages/dashboard.js") }}'></script>
</body>
</html>
