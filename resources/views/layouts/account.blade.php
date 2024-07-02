<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Account Portal</title>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <!-- JQueryUI -->
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.8/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.3/date-1.5.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.8/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.3/date-1.5.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.js"></script>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
  
  <!-- Sweet Alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @stack('scripts')
        
  <!-- Customized  -->
  <style type="text/css">
    #sidebar {
      background: #393c44;
      min-height: 100vh;
    }

    .bt-1-solid {
      border-top: 1px solid #ccc;
    }

    .bb-1-dashed {
      border-bottom: 1px dashed #ccc;
    }
  </style>
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