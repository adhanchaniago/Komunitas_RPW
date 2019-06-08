@extends('template.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="tabbable" id="tabs-153735">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" href="#tab1" data-toggle="tab">Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#tab2" data-toggle="tab">New</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        {{-- <h4>Ini Pop</h4> --}}
                        @foreach($popular as $item)
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <a href="{{ route('posts.show', $item->title) }}">{{ $item->title }}</a>&nbsp;by&nbsp;<a href="{{ route('users.show', $item->username) }}">{{ $item->username }}</a>
                </div>
                <div class="row">
                    <a href="{{ route('comunity.show', $item->name) }}">{{ $item->name }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/'.$item->media) }}" alt="" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <p class="lead small">{{ Str::words($item->content, 30, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
        <br>
        @endforeach
                    </div>
                    <div class="tab-pane" id="tab2">
                        {{-- <h4>Ini New</h4> --}}
                        @foreach($newPost as $item)
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <a href="{{ route('posts.show', $item->title) }}">{{ $item->title }}</a>&nbsp;by&nbsp;<a href="{{ route('users.show', $item->username) }}">{{ $item->username }}</a>
                </div>
                <div class="row">
                    <a href="{{ route('comunity.show', $item->name) }}">{{ $item->name }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/'.$item->media) }}" alt="" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <p class="lead small">{{ Str::words($item->content, 30, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
        <br>
        @endforeach
                    </div>
                </div>
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
				<a class="nav-link active" href="{{ route('community.index') }}">
					<span class="fa fa-object-group"></span>
					Komunitas
				</a>
			</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <span class="fas fa-sticky-note"></span>
                    Post
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reply.index') }}">
                    <span class="fas fa-comment"></span>
                    Reply
                </a>
            </li>
		</ul>
	</div>
</nav>
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