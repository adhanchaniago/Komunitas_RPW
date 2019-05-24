<!DOCTYPE html>
<html lang="en">
	@include('template.partials._head')
	<body>
		@include('template.partials._top')
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 px-4 bg-putih">
					@yield('content')
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 px-4 bg-primary">
					@yield('diffContent')
				</div>
			</div>
		</div>
		@include('template.partials._script')
	</body>
</html>