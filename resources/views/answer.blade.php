<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title> </title>

        
<!-- Favicon -->
<link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="" rel="stylesheet">

<!-- Icons -->
<link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet">
<link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!--  CSS -->
<link type="text/css" href="/assets/css/argon-dashboard.css" rel="stylesheet">

    </head>

    <body>
       @yield('content')

        
<!-- Core -->
<script src="/assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--  JS -->
<script src="/assets/js/argon-dashboard.min.js"></script>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="/assets/js/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
    {!! $chart->script() !!}
    {!! $chart2->script() !!}


</html>
