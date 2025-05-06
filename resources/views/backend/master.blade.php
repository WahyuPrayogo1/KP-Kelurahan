<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Absensi</title>
    <!-- CSS files -->
    <link href="{{asset('backend/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('backend/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('backend/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('backend/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('backend/css/demo.min.css?1692870487')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
        @stack('styles')

  </head>
  <body >
    <script src="{{asset('backend/js/demo-theme.min.js?1692870487')}}"></script>
    <div class="page">
        @include('backend.components.header')
      <div class="page-wrapper">
        <!-- Page header -->

        <!-- Page body -->
        <div class="page-body">
          @yield('content')
        </div>
        @include('backend.components.footer')
      </div>
    </div>

    <script src="{{asset('backend/js/tabler.min.js?1692870487')}}" defer></script>
    <script src="{{asset('backend/js/demo.min.js?1692870487')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
  </body>
</html>
