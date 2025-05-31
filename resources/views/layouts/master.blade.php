<!DOCTYPE html>
<html
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />

    <title>@yield('title')</title>



      <!-- Canonical SEO -->

        <meta name="description" content="Sneat Free is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
        <meta name="keywords" content="Sneat free dashboard, Sneat free bootstrap dashboard, free admin, free theme, open source, free, MIT license" />
        <meta property="og:title" content="Sneat Bootstrap Dashboard FREE by ThemeSelection" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="https://themeselection.com/item/sneat-dashboard-free-bootstrap/" />
        <meta property="og:image" content="https://ts-assets.b-cdn.net/ts-assets/sneat/sneat-bootstrap-html-admin-template-free/marketing/sneat-hrml-free-smm-banner.png" />
        <meta property="og:description" content="Sneat Free is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
        <meta property="og:site_name" content="ThemeSelection" />
        <link rel="canonical" href="https://themeselection.com/item/sneat-dashboard-free-bootstrap/" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />



      <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
      <script>
        (function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
          var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
          f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');
      </script>
      <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset("/assets/vendor/fonts/iconify-icons.css") }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset("assets/vendor/css/core.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset("assets/css/demo.css") }}" />
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #map {
            height: 600px;
        }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }
        .legend {
            line-height: 18px;
            color: #555;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>

    <!-- Vendors CSS -->

      <link rel="stylesheet" href="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />

    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/flatpickr/flatpickr.css") }}" />
  <!-- Row Group CSS -->
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css") }}" />
  <!-- Form Validation -->
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/@form-validation/form-validation.css") }}" />




    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

      <script src="{{ asset("assets/js/config.js")}}"></script>

</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')
            <div class="layout-page">
                @include('layouts.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>

    <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/@algolia/autocomplete-js.js") }}"></script>




    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
      <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>

      <script src="{{ asset("assets/vendor/js/menu.js") }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset("assets/vendor/libs/apex-charts/apexcharts.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") }}"></script>
    <!-- Flat Picker -->

    <!-- Main JS -->
    <script src="{{ asset("assets/vendor/libs/@form-validation/bootstrap5.js") }}"></script>
      <script src="{{ asset("assets/js/main.js") }}"></script>


    <!-- Page JS -->
    <script src="{{ asset("assets/js/dashboards-analytics.js") }}"></script>
    <script src="{{ asset("assets/js/tables-datatables-basic.js") }}"></script>
    @stack('js')
</body>

</html>