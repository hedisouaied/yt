<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin || Tableau de bord</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">
    <!-- Summernote -->
	<link rel="stylesheet" href="{{asset('backend/assets/summernote/summernote.css')}}">
	<!-- Main Styles -->
	<link rel="stylesheet" href="{{asset('backend/assets/styles/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css')}}">
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="{{asset('backend/assets/fonts/material-design/css/materialdesignicons.css')}}">
	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">
	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/waves/waves.min.css')}}">
	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/sweet-alert/sweetalert.css')}}">
    <!-- Dropify -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/dropify/css/dropify.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/select2/css/select2.min.css')}}">
	<!-- Percent Circle -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/percircle/css/percircle.css')}}">
	<!-- Chartist Chart -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/chart/chartist/chartist.min.css')}}">
	<!-- FullCalendar -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/fullcalendar/fullcalendar.print.css')}}">

    @if (isset($sc))
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    @endif

    <style>
        .modal-backdrop.in{display: none !important;}
    </style>
