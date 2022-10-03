
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pertanian</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="/template/js/select.dataTables.min.css">
  
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/logo.png" />

   <!-- plugins:js -->
  <script src="/template/vendors/js/vendor.bundle.base.js"></script>
  <script src="/template/vendors/select2/select2.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="/template/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="/template/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
   <!-- endinject -->

  <style>
    .navbar .navbar-brand-wrapper .navbar-brand img{
        height: 60px !important;
    }
    .sidebar .nav .nav-item.active > .nav-link{
        background: #50A365;
        position: relative;
    }
    .sidebar .nav .nav-item.active > .nav-link {
        background: #50A365;
        position: relative;
    }
    .sidebar .nav .nav-item > .nav-link:hover {
        background: #50A365 !important;
        position: relative;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        color: #000;
        margin-top: -5px;
        line-height: unset;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        display: block;
        padding-left: unset;
        padding-right: unset;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .btn-success{
        color: #fff;
        background-color: #50A365;
        border-color: #50A365;
    }
    .text-success{
        color: #50A365 !important;
    }
    .pagination .page-item.active .page-link, .jsgrid .jsgrid-pager .page-item.active .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-page .page-link, .pagination .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .page-item.active .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button a, .pagination .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .page-item.active .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-page a, .pagination .page-item:hover .page-link, .jsgrid .jsgrid-pager .page-item:hover .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:hover .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-page:hover .page-link, .pagination .page-item:hover .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .page-item:hover .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item:hover a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:hover a, .pagination .page-item:hover .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .page-item:hover .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item:hover a, .jsgrid .jsgrid-pager .jsgrid-pager-page:hover a, .pagination .page-item:focus .page-link, .jsgrid .jsgrid-pager .page-item:focus .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:focus .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-page:focus .page-link, .pagination .page-item:focus .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .page-item:focus .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item:focus a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:focus a, .pagination .page-item:focus .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .page-item:focus .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item:focus a, .jsgrid .jsgrid-pager .jsgrid-pager-page:focus a, .pagination .page-item:active .page-link, .jsgrid .jsgrid-pager .page-item:active .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:active .page-link, .jsgrid .jsgrid-pager .jsgrid-pager-page:active .page-link, .pagination .page-item:active .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .page-item:active .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item:active a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button:active a, .pagination .page-item:active .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .page-item:active .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item:active a, .jsgrid .jsgrid-pager .jsgrid-pager-page:active a{
        background: #50A365;
        border-color: #50A365;
        color: #ffffff;
    }
    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .count-indicator .count{
        background: #50A365;
    }
    .form-group {
      margin-bottom: 0rem
    }
    .content {
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  @php
    $allNotifications = \App\Models\Notification::orderBy('created_at','DESC')->get();
    $notReadNotifications = \App\Models\Notification::where('is_readed',0)->get();
    $readeadNotifications = \App\Models\Notification::where('is_readed',1)->get();
  @endphp
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard.index')}}"><img src="/images/logo.png" class="mr-2" alt="logo"/></a>
        {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown notifications">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count-circle {{count($notReadNotifications) != 0 ? 'count' : ''}}"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              @foreach ($allNotifications as $allNotification)
                <a class="dropdown-item preview-item" href="{{$allNotification->link}}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="ti-info-alt mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">
                      {{$allNotification->title}}
                    </h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      {{$allNotification->body}}
                    </p>
                    
                    <p class="font-weight-light small-text mb-0 text-muted">
                      {{$allNotification->created_at->format('Y-m-d');}}
                    </p>
                  </div>
                </a>
              @endforeach
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              {{-- <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a> --}}
              <a class="dropdown-item" href="{{route('logout')}}">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item {{Request::is('dashboard','dashboard/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('dashboard.index')}}">
                <i class="ti-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item {{Request::is('manajemen-user','manajemen-user/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('manajemen-user.index')}}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Manajemen User</span>
              </a>
            </li>
            <li class="nav-item {{Request::is('laporan','laporan/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('laporan.index')}}">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Laporan</span>
              </a>
            </li>
            <li class="nav-item {{Request::is('saran','saran/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('saran.index')}}">
                <i class="ti-comment-alt menu-icon"></i>
                <span class="menu-title">Saran</span>
              </a>
            </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          {{$slot}}
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/template/vendors/chart.js/Chart.min.js"></script>
  <script src="/template/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="/template/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/template/js/off-canvas.js"></script>
  <script src="/template/js/hoverable-collapse.js"></script>
  <script src="/template/js/template.js"></script>
  <script src="/template/js/settings.js"></script>
  <script src="/template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/template/js/dashboard.js"></script>
  <script src="/template/js/Chart.roundedBarCharts.js"></script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/template/js/select2.js"></script>
  
  <!-- End custom js for this page-->
  @if (session('ERR'))
    <script>
      Swal.fire({
        title: "ERROR!",
        text: "{{ session('ERR') }}",
        icon: "error",
        confirmButtonClass: "btn btn-primary",
      });
    </script>
    @endif
    @if (session('OK'))
        <script>
        Swal.fire({
            title: "OK!",
            text: "{{ session('OK') }}",
            icon: "success",
            confirmButtonClass: "btn btn-primary",
        });
        </script>
    @endif

    <script>
      $('.count-circle').on('click', function() {
        try {
          $('.count-circle').removeClass('count');
          $.ajax({
           url: "{{route('laporan.read-all-notifications')}}"
          });
        } catch (error) {
          
        }
      })
      $('.notifications').on('click', function() {
        try {
          $('.count-circle').removeClass('count');
          $.ajax({
           url: "{{route('laporan.read-all-notifications')}}"
          });
        } catch (error) {
          
        }
      })
    </script>
</body>

</html>

