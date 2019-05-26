@extends('template.app')
@section('content')
<div class="container">
	<div class="card" style="max-width: 70%; margin:auto; margin-top:40px;">
		<div class="card-header text-white">
			<h5>Create Interesting Post</h5>
		</div>
		<div class="card-body">
			<div class="container text-primary">
				<form action="{{ route('posts.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row" >
						<div class="col-md-3">
							<label for="comunity_id">Community</label>
						</div>
						<div class="col-md-8">
							<select name="comunity_id" class="custom-select">
								<option value="" selected>-- SELECT A COMMUNITY --</option>}
								@foreach ($comunity as $item)
									<option value="{{ $item->comunity_id }}">{{ $item->name }}</option>
								@endforeach
							</select>
							<div class="invalid-feedback">
								{{$errors->first('comunity_id')}}
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label for="media">Picture</label>
						</div>
						<div class="col-md-8">
							<div class="custom-file">
								<label for="media" class="custom-file-label">Interesting Picture (OPTIONAL)</label>
								<input type="file" class="custom-file-input {{$errors->first('media') ? "is-invalid": ""}}" name="media" id="media">
								<div class="invalid-feedback">
									{{$errors->first('media')}}
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row" >
						<div class="col-md-3">
							<label for="title" >Title</label>
						</div>
						<div class="col-md-8">
							<input value="{{ old('title') }}" type="text" class="form-control {{$errors->first('title') ? "is-invalid": ""}}" name="title"	id="title" placeholder="Interesting Title">
							<div class="invalid-feedback">
								{{$errors->first('title')}}
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label for="content">Content</label>
						</div>
						<div class="col-md-8">
							<textarea name="content" class="form-control {{$errors->first('content') ? "is-invalid": ""}}" id="content" cols="20" rows="5">{{ old('content') }}</textarea>
							<div class="invalid-feedback">
								{{$errors->first('content')}}
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