<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="AMSW - FK UNAIR">
    <meta name="author" content="Software Silo">
    <meta name="keyword" content="Medicine Competition University">

    <title>AMSW <?php echo date("Y"); ?> Dashboard</title>
    
    <!-- Icons-->
    <link href="{{asset('dashboard/node_modules/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/node_modules/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
{{--     <link href="{{asset('dashboard/node_modules/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('dashboard/node_modules/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    
    <!-- Main styles for this application-->
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">
    <style>
      .card-content{
        box-shadow: 0px 0px 0px grey;
            -webkit-transition:  box-shadow .2s ease-out;
          box-shadow: .8px .9px 3px grey;
      }

      .card-content:hover{ 
          box-shadow: 1px 8px 20px grey;
            -webkit-transition:  box-shadow .2s ease-in;
        }
    </style>
    @yield('style')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show aside-menu-lg-show"">
   
    @include('includes.participant.header')

    <div class="app-body">
     
        @include('includes.participant.sidebar')

      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Participant</li>
          <li class="breadcrumb-item active">@yield('path')</li>

{{--           <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-speech"></i>
              </a>
              <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
              <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
            </div>
          </li> --}}
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            
            @yield('content')

          </div>
        </div>
      </main>
      @include('includes.participant.aside')
    </div>
    <footer class="app-footer">
      <div>
        <span>Hand-crafted & made with <i class="fas fa-heart" style="color: red" aria-hidden="true"></i></span>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('dashboard/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/node_modules/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('dashboard/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('dashboard/node_modules/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
    {{-- <script src="{{asset('dashboard/node_modules/chart.js/dist/Chart.min.js')}}"></script> --}}
{{--     <script src="{{asset('dashboard/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script> --}}
    <script src="{{asset('dashboard/js/main.js')}}"></script>
    @yield('script')
  </body>
</html>
