<!DOCTYPE html>
<html lang="en">
	@include('template.partials._head')
	<body>
		@include('template.partials._top')
		{{-- <nav>
			<ul>
				<li><a href="" title="">asd</a></li>
			</ul>
		</nav> --}}
		<div class="container-fluid">
			<div class="row">
				<main role="main" class="col-md-9 px-4 bg-putih">
					@yield('content')
				</main>
				<div class="col-md-3 ml-sm-auto px-4 bg-primary">
					@yield('sidebar')
				</div>
			</div>
		</div>
		@include('template.partials._script')
	</body>
</html>