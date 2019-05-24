@extends('template.app')
<div class="container">
@section('content')
<br>
{{-- Cek Follower atau bukan --}}
@foreach($followers as $item)
@if($item->username == Auth::user()->username)
<?php   $bool = true;
        $comun = $item->name; ?>
@else
<?php   $bool = false; 
        $comun = $item->name; ?>
@endif
@endforeach
<div class="row">
    <div class="col-md-12">
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/'.$info['banner']) }}" alt="" class="d-block w-100 img-fluid img-bulat">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-4 mb-0 bg-dark nama-komunitas"><u>{{ $info['name'] }}</u></h2>
                        <p class="lead">{{ $info['followers'] }}&nbsp;Members</p>
                        {{-- Bukan Follower --}}
                        @if($bool == true)
                            <a class="btn btn-danger btn-danger-un w-100 my-auto" href="{{ route('comunity.unfollow',$comun) }}" title="">Unfollow</a>
                        {{-- Follower --}}
                        @else
                            <a class="btn btn-success btn-success-un w-100 my-auto" href="{{ route('comunity.follow',$comun) }}" title="">Follow</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><hr>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title text-center">
                <h4><strong>Upcoming Events</strong></h4>
            </div>
@foreach($event as $item)
<div class="card">
    <div class="card-body">
        <h4 class="lead">{{ $item->event_name }}</h4><br>At
        <small>{{ $item->date }}</small>
    </div>
</div>
@endforeach
    </div>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-title">
        <div class="card-title text-center">
                <h4><strong>Posts</strong></h4>
            </div>
@foreach($comunity as $item)
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <a class="lead" href="{{ route('posts.show', $item->title) }}">{{ $item->title }}</a>&nbsp;By&nbsp;<a href="{{ route('users.show', $item->username) }}">{{ $item->username }}</a>
                        <br>On&nbsp;<a href="{{ route('comunity.show', $item->name) }}">{{ $item->name }}</a>
                    </div>
                    <div class="col-md-4 text-right">
                        @if($item->user_id == Auth::user()->id)
                            <a class="btn btn-info text-white" href="{{ route('posts.edit',$item->title) }}">Edit</a>
                            <a class="btn btn-danger text-white" href="{{ route('posts.delete',$item->title) }}">Hapus</a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="lead">{{ Str::words($item->content, 30, '...') }}</p>
            </div>
            <div class="card-footer">
                {{ $item->vote }}
                {{-- <div class="row">
                    <button onclick="actOnPost(event);" data-chirp-id="{{ $item->post_id }}">Like</button>
                    <span id="likes-count-{{ $item->post_id }}">{{ $item->vote }}</span>
                </div> --}}
            </div>
            <br>
            </div>
    </div>
</div>
<br>
@endforeach
</div>
</div>
@endsection
@section('sidebar')
<br>
<hr>
@if($bool == true)
<div class="row">
    <div class="col-md-12 text-justify">
        <a class="btn btn-warning w-100 my-auto" href="{{ route('event.create',$comun) }}" title="">Create Event</a>
    </div>
</div>
<br>
@endif
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