<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Research DB System</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/sweetalert2.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/preloader.css') }}" rel="stylesheet">

  <style>
    @media (max-width: 768px) {
      #content-wrapper {
        margin-left: 0 !important;
      }
    }

    body {
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body id="page-top">

  <div id="preloader">
    <div id="my-background"></div>
    <div id="loader"></div>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">
  
    <!-- Sidebar -->
    @include('editor.views.layouts.sidebar')
    <!-- End of Sidebar -->
  
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
  
      <!-- Main Content -->
      <div id="content">
  
        <!-- Topbar -->
        @include('editor.views.layouts.navbar')
        <!-- End of Topbar -->
  
        <!-- Begin Page Content -->
        <div class="container-fluid offset-1 w-8 mt-5">
  
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
          </div>
  
          <div class="mx-2 text-dark">
            @yield('contents')
          </div>
          
  
          <!-- Content Row -->
  
  
        </div>
        <!-- /.container-fluid -->
  
      </div>
      <!-- End of Main Content -->
  
      <!-- Footer -->
      @include('editor.views.layouts.footer')
      <!-- End of Footer -->
  
    </div>
    <!-- End of Content Wrapper -->
  
  </div>
  <!-- End of Page Wrapper -->
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

  <script src="{{ asset('admin_assets/js/sweetalert2.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sweetalert.js') }}"></script>
  <script src="{{ asset('admin_assets/js/recordtable.js') }}"></script>
  <script src="{{ asset('admin_assets/js/selectedcheckbox.js') }}"></script>
  <script src="{{ asset('admin_assets/js/closemodal.js') }}"></script>
  <script src="{{ asset('admin_assets/js/showitemonclick.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>

  <script>
    window.addEventListener("load", function(){
      document.getElementById("preloader").style.display = "none";
    });
  </script>
  
    <!-- <script>
    window.addEventListener("load", function() {
      setTimeout(function() {
        document.getElementById("preloader").style.display = "none";
      }, 1000);
    });
  </script> -->

  <script src="{{ asset('vanta-master/vendor/three.r134.min.js') }}"></script>
  <script src="{{ asset('vanta-master/dist/vanta.halo.min.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      VANTA.HALO({
        el: "#my-background",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00
      });
    });
  </script>
</body>
</html>