<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Komunitas">
	<meta name="author" content="Kelompok 4">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	@yield('css')
</head>