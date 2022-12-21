<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap"> -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
 
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- for new dashboard style we need to include this on main css -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

    
    <!--        <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">-->

    <link rel="stylesheet" href="{{ asset('/css/common.css') }}">

    <style>
        .nav-item a{
            margin-bottom: 2px !important;
        }
    </style>


</head>

<body class="sidebar-mini layout-fixed accent-yellow " id="main-bdy" style="height: auto;">
        <!-- 
          <div class="loader-ajax">
            <img src="{{asset('dist/img/2021-03-22.gif')}}" alt="loader">
          </div>
      -->
      <div class="wrapper" id="">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav header-link-mnu">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
              
             
            </ul>

            <!-- Search Form Backup -->


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dark-dsh-light" id="ss-mode">
                    <label class="toggle-inner">
                      <!-- <input type="checkbox" name="checkbox" id="checkbox"> -->
                      <span></span>
                      <i class="indicator"></i>
                  </label>
              </li>
              
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-warning sidebar-no-expand dam-sidebar">
        <!-- Brand Logo -->
        
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 73px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  
                </div>
                <div class="info">
                    <p> 
                    </div>
                </div>


                <!--Done SidebarSearch Form-->
  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
                                           with font-awesome or any other icon font library -->
                                           <li class="nav-item">
                                            <a href="{{route('home')}} " class="nav-link">
                                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                                <p>
                                                    Dashboard
                                                </p>
                                            </a>
                                        </li>
                                       
                                        <li class="nav-item">
                                           
                                            <ul class="nav nav-treeview">

                                                <li class="nav-item">
                                                    <a href="{{route('CREATECOM')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Create Commercials</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('viewCOM')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Commercials List</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('CREATECATALOG')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Create Commercials Logs</p>
                                                    </a>
                                                </li>

                                                 <li class="nav-item">
                                                    <a href="{{route('viewCommercial')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Commercial Logs List</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('CREATELOT')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Create Lots</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('CREATELOTCATALOG')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Create Lots CataLogs</p>
                                                    </a>
                                                </li>

                                                 <li class="nav-item">
                                                    <a href="{{route('VIEWLOTCATALOG')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> Lots CataLogs List</p>
                                                    </a>
                                                </li>


                                                {{-- <li class="nav-item">
                                                    <a href="{{route('CREATEWRC')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> Create WRCs</p>
                                                    </a>
                                                </li> --}}

                                                 <li class="nav-item">
                                                <a href="{{ route('CREATECATLOGWRC') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Create Catlog WRCs</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('viewCatalogWRC') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>View Catlog WRCs</p>
                                                </a>
                                            </li>
                                                
                                                {{-- Allocation section {{route('CREATEWRC')}}  --}}
                                                <li class="nav-item">
                                                    <a href="{{route('CATALOG_ALLOCT')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> Catalog Allocation</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('CATALOG_ALLOCTED_DETAILS')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> Catalog Allocation Details</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('CATALOG_UPLOAD')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> Catalog Upload</p>
                                                    </a>
                                                </li>
                                                {{--End Allocation section   --}}

                                                <li class="nav-item">
                                                    <a href="{{route('QcList')}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p> QC Status</p>
                                                    </a>
                                                </li>


                                            </ul>
                                        </li>
                                  
                        </ul>
                    </nav>  <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
    </div>



    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
        <div class="os-scrollbar-track">
            <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);">

            </div>
        </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 42.5278%; transform: translate(0px, 0px);">
        </div>
    </div>
</div>
<div class="os-scrollbar-corner"></div>
</div>
<!-- /.sidebar -->
</aside>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 ">
            </div>
            <!-- /.col -->
            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="copy-msg"><p>Copied!</p></div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: transparent;">
    @yield('content')
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright © 2021 <a href="https://odndigital.com">ODN | Connect</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.1
    </div>
</footer>

<a href="#top" id="back-to-top">
    <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <g id="_24x24_On_Light_Arrow-Top" data-name="24x24/On Light/Arrow-Top" transform="translate(24) rotate(90)">
            <rect id="view-box" width="24" height="24" fill="none"/>
            <path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="#141124"/>
        </g>
    </svg>
</a>

<div class="fixed-search-wrapper">
    <a href="javascript:;" class="search-tg-btn" id="search-toggle-btt">
        <i class="fas fa-search"></i>
    </a>
    <!-- SEARCH FORM -->
    <div class="input-group input-group-sm hdr-search-wrapper">
        <input class="form-control form-control-navbar hdr-search" type="search" placeholder="Enter" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" data-search="next" type="button">∨</button>
            <button class="btn btn-navbar" data-search="prev" type="button">∧</button>
            <button class="btn btn-navbar" data-search="clear" type="button">?</button>
        </div>
    </div>
</div>


<!-- jQuery -->

<script src ="{{ asset('/js/app.js')}}"  ></script>



<script type="application/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="application/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>


<div id="sidebar-overlay"></div></div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->

<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart --><!-- daterangepicker -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


<!-- overlayScrollbars --><!--
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script src="{{asset('js/select2.full.min.js')}}"></script>

    <script src="{{ asset('plugins/jquery-cookie-master/src/jquery.cookie.js') }}"></script>
    <script>
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

</script>
 @yield('datatable')
 @yield('customScript')

</body>
</html>
