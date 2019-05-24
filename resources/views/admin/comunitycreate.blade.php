@extends('template.app')
@section('content')
<br>
<div class="card border-dark" style="max-width: 70%; margin:auto; margin-top:40px;">
        <div class="card-header bg-dark text-white">
            <h5> Create a New Comunity</h5>
        </div>
        <div class="card-body">
            <div class="container text-primary">
                <form action="{{ route('community.store') }}" class="form-group" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row" >
                        <div class="col-md-3">
                            <label for="type" >Type</label>
                        </div>
                        <div class="col-md-8">
                            <input value="{{ old('type') }}" type="text" class="form-control {{$errors->first('type') ? "is-invalid": ""}}" name="type" id="type">
                            <div class="invalid-feedback">
                                {{$errors->first('type')}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input value="{{ old('name') }}" type="text" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" name="name" id="name">
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            Banner
                        </div>
                        <div class="col-md-8">
                            <div class="custom-file">
                                <label for="banner" class="custom-file-label">Awesome Banner</label>
                                <input type="file" class="custom-file-input {{$errors->first('banner') ? "is-invalid": ""}}" name="banner" id="banner">
                                <div class="invalid-feedback">
                                    {{$errors->first('banner')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 offset-md-5 offset-sm-4">
                            <button type="submit" class="btn btn-outline-dark">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('sidebar')
<br>
<nav class="col-md-12 d-none d-md-block bg-light sidebar card">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link active" href="{{ route('user.index') }}">
					<span class="fas fa-user"></span>
					Pengguna
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('community.index') }}">
					<span class="fa fa-object-group"></span>
					Komunitas
				</a>
			</li>
		</ul>
	</div>
</nav>
<br>
@endsection