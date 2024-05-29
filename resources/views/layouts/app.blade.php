<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <link href='https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css' rel='stylesheet'>
  <link href='https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css' rel='stylesheet'>
  
  <style>
    @media (max-width: 768px) {
      #content-wrapper {
        margin-left: 0 !important;
      }
    }
  </style>
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
  
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->
  
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
  
      <!-- Main Content -->
      <div id="content">
  
        <!-- Topbar -->
        @include('layouts.navbar')
        <!-- End of Topbar -->
  
        <!-- Begin Page Content -->
        <div class="container-fluid offset-1 w-8 mt-5">
  
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
          </div>
  
          <div class="mx-2">
            @yield('contents')
          </div>
          
  
          <!-- Content Row -->
  
  
        </div>
        <!-- /.container-fluid -->
  
      </div>
      <!-- End of Main Content -->
  
      <!-- Footer -->
      @include('layouts.footer')
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

  <script src="{{ asset('admin_assets/js/sweetalert.js') }}"></script>
  <script src="{{ asset('admin_assets/js/recordtable.js') }}"></script>
  <script src="{{ asset('admin_assets/js/selectedcheckbox.js') }}"></script>
  <script src="{{ asset('admin_assets/js/closemodal.js') }}"></script>
  <script src="{{ asset('admin_assets/js/showitemonclick.js') }}"></script>

  <script src='https://code.jquery.com/jquery-3.7.1.js'></script>
  <script src='https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js'></script>
  <script src='https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js'></script>
  <script src='https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js'></script>
  <script src='https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        @if(isset($researchPerYear))
            var years = @json($researchPerYear->pluck('year'));
            var counts = @json($researchPerYear->pluck('total'));

            var ctx = document.getElementById('researchPerYearChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Research',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            @endif
    </script>
</body>
</html>