<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Account Portal</title>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- JQueryUI -->
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">


  <!-- DataTables Buttons -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
  
  <!-- Sweet Alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
        
  <!-- Customized  -->
  <style type="text/css">
    #sidebar {
        background: #393c44;
        min-height: 100vh;
    }

    .excellent {
      background-color: #ccffe5 !important;
    }

    .good {
      background-color: #e5fff2 !important;
    }

    .fair {
      background-color: #fff2e5 !important;
    }

    .poor {
      background-color: #ffe5e5 !important;
    }
  </style>

  @stack('scripts')
</head>
<body>
  <main class="container-fluid">
    <div class="row">
      <div id="sidebar" class="col-md-2 d-none d-lg-block">@include('components.sidebar')</div>
      <div id="main" class="col-md-10">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
      </div>
    </div>
  </main>
</body>
</html>