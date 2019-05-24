@extends('template.app')
<div class="container">
@section('content')
<div class="container" >
	@if ($errors->any())
	<br>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </div>
@endif
	<div class="card" style="max-width: 70%; margin:auto; margin-top:40px;">
		<div class="card-header bg-dark">
			<h5 class="text-white">Post an Interesting Event</h5>
		</div>
		<div class="card-body">
			<div class="container text-primary">
				<form action="{{ route('event.store',$com_name['name']) }}" class="form-group" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row" >
						<div class="col-md-3">
							<label for="type">What is The Event</label>
						</div>
						<div class="col-md-8">
							<input value="{{ old('type') }}" type="text" class="form-control {{$errors->first('type') ? "is-invalid": ""}}" name="type"	id="type" placeholder="Interesting Event">
							<div class="invalid-feedback">
								{{$errors->first('type')}}
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label for="content">Describe Your Event</label>
						</div>
						<div class="col-md-8">
							<textarea name="content" class="form-control {{$errors->first('content') ? "is-invalid": ""}}" id="content" cols="20" rows="5">{{ old('content') }}</textarea>
							<div class="invalid-feedback">
								{{$errors->first('content')}}
							</div>
						</div>
					</div>
					<br>
					<div class="row" >
						<div class="col-md-3">
							<label for="date" >When Is Your Event</label>
						</div>
						<div class="col-md-8">
							<input value="{{ old('date') }}" type="date" class="form-control {{$errors->first('date') ? "is-invalid": ""}}" name="date" id="date" placeholder="Interesting Title">
							<div class="invalid-feedback">
								{{$errors->first('date')}}
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3 offset-md-5 offset-sm-4">
							<button type="submit" class="btn btn-outline-primary">Create</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br>
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
</div>