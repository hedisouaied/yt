	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!--
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
    @if (!isset($sc))
    <script src="{{asset('backend/assets/scripts/jquery.min.js')}}"></script>
    @endif

    <script src="{{asset('backend/assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/waves/waves.min.js')}}"></script>
	<!-- Full Screen Plugin -->
	<script src="{{asset('backend/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>
	<!-- Google Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- chart.js Chart -->
	<script src="{{asset('backend/assets/plugin/chart/chartjs/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/chart.chartjs.init.min.js')}}"></script>
	<!-- FullCalendar -->
	<script src="{{asset('backend/assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/fullcalendar.init.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/popover/jquery.popSelect.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/multiselect/multiselect.min.js')}}"></script>
    <!-- Dropify -->
	<script src="{{asset('backend/assets/plugin/dropify/js/dropify.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/fileUpload.demo.min.js')}}"></script>
    <!-- Data Tables -->
	<script src="{{asset('backend/assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/datatables.demo.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('backend/assets/summernote/summernote.js')}}"></script>
	<!-- Sparkline Chart -->
	<script src="{{asset('backend/assets/plugin/chart/sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/chart.sparkline.init.min.js')}}"></script>

<!-- Demo Scripts teb3a select2_1 -->
<script src="{{asset('backend/assets/scripts/form.demo.min.js')}}"></script>


	<script src="{{asset('backend/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('backend/assets/color-switcher/color-switcher.min.js')}}"></script>

    @yield('scripts')
