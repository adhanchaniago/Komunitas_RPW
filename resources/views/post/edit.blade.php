@extends('template.app')
{{-- <div class="container"> --}}
@section('content')
<div class="card" style="max-width: 70%; margin:auto; margin-top:40px;">
	<div class="card-header bg-dark text-white">
		<h5>{{ $posts['title'] }}</h5>
	</div>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="card-body">
		<div class="container text-primary">
			<form action="{{ route('posts.update',$posts['title']) }}" class="form-group" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row" >
				<div class="col-md-3">
					<label for="content">Content</label>
				</div>
				<div class="col-md-8">
					<textarea name="content" class="form-control {{$errors->first('content') ? "is-invalid": "" }}" id="content" cols="20" rows="5">{{ old('content') }}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-group mb-3">
					<div class="col-md-3 text-primary">
						<label for="media">Picture</label>
					</div>
					<div class="col-md-8">
						<img src="{{asset('storage/'.$posts['media'])}}" class="card mb-sm-2" height="170px" width="150px" alt="">
						<div class="custom-file">
							<label for="Media" class="custom-file-label">Interesting Picture</label>
							<input type="file" class="custom-file-input" name="Media" id="Media">
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-3 offset-md-5 offset-sm-4">
					<button type="submit" class="btn btn-outline-info" >Update</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
{{-- </div> --}}
@endsection
@section('sidebar')
<br>
<div class="row">
    <div class="col-12">
        <div class="card">
                <h5 class="card-header">
                    OlaWikiWiki
                </h5>
                <div class="card-body">
                    <p class="card-text">
                        &copy;Kelompok 4
                    </p>
                </div>
                <div class="card-footer">
                    2019
                </div>
            </div>
    </div>
</div>
@endsection