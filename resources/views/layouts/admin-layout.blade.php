<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.style')
    @stack('styles')
	{{-- @notifyCss --}}
</head>
<body>
	<div class="wrapper">
		@include('partials.header')
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			@include('partials.sidebar')
		</div>
		<div class="main-panel">
            <div class="page-inner">
                {{ $slot }}
            </div>
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		{{-- @include('partials.custom') --}}
		<!-- End Custom template -->
	</div>
	{{-- @notifyJs --}}
	{{-- @include('notify::messages') --}}
	@stack('modal')
	@include('partials.script')
    @stack('scripts')
</body>
</html>