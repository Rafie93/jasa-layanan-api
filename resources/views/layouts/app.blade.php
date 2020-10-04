<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Neopedia || @yield('title')</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap, select2 & fontawesome -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{asset('assets/css/colorbox.min.css')}}" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}" />

        <!-- toast dan alert -->
        <link href="{{asset('assets/sweetalert/sweetalert.css')}}" rel="stylesheet">
        <link href="{{asset('assets/sweetalert/sweetalert.hack.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">

        @yield('style')
	</head>

	<body class="no-skin">
        @include('layouts.partials.header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

            @include('layouts.partials.sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
                            @yield('breadcrumb')
						</ul>
					</div>

					<div class="page-content">
                        @yield('content')
					</div>
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Neopedia</span>
							Application &copy; {{ date('Y') }}
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->


    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.colorbox.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>

    <script src="{{asset('assets/toastr/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <script>
        $( function() {
        $( ".tanggal" ).datepicker({
                format: 'yyyy-mm-dd',
            });
        } );
        $('.select2').select2();

        @if(Session::has('sukses'))
            toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
        @endif
        @if(Session::has('gagal'))
            toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
        @endif
    </script>

    @yield('script')
    @yield('footer')

	</body>
</html>
