<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('public\frontend\img\home\3d-logo.png')}}">
    @section('head')
        @include('layouts.head')
    @show

    @section('css')
        @include('layouts.css')
    @show

    @section('head_scripts')
        @include('layouts.head_scripts')
    @show
</head>
<body>
    <div class="wrapper">
		<div class="header-wrapper">	
			@section('header')
				@include('layouts.header')
			@show
		</div>

		<div class="content-wrapper">
			@yield('content')
		</div>

		<footer class="footer">
			@section('footer')
				@include('layouts.footer')
			@show
		</footer>
	</div>

	@section('body_scripts')
		@include('layouts.body_scripts')
	@show
</body>
</html>