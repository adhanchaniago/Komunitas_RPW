@extends('template.app')
<div class="container">
@section('content')
<br>
<div class="row">
	<div class="card w-100">
		<div class="card-header">
            <div class="row">
            <div class="col-md-8">
                {{ $post->title }}&nbsp;by&nbsp;<a href="{{ route('users.show', $post->user->username) }}">{{ $post->user->username }}</a>
                <br>On&nbsp;
                <a href="{{ route('comunity.show', $post->comunity->name) }}">{{ $post->comunity->name }}</a>
            </div>
            @if($post->user->username == Auth::user()->username)
            <div class="col-md-4 text-right">
                <a class="btn btn-info text-white" href="{{ route('posts.edit',$post->title) }}">Edit</a>
                <form class="d-inline" onsubmit="return confirm('Delete this post permanently?')" action="{{ route('posts.delete',$post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger text-white">Hapus</button>
                </form>
            </div>
            @endif
            </div>
		</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<img src="{{ asset('storage/'.$post->media) }}" alt="asd" class="img-fluid img-thumbnail">
			</div>
            <hr>
			<div class="row">
                <p id="artikel">{{ $post['content'] }}</p>
			</div>
		</div>
		<div class="card-footer">
		</div>
	</div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        {{-- @include('post.comments', ['comments' => $comment]) --}}
        <div id="commentBody">
        @foreach($comment as $item)
        <div class="row">
            <div class="col-md-12">
                <div class="card w-100">
                    <div class="card-header">
                        <i class="fas fa-arrow-right"></i> <a href="{{ route('users.show', $item->username) }}">
                        <strong>{{ $item->username }}</strong>
                        @if($post->user->username == $item->username)
                            <span class="ml-2 badge badge-success">THREAD STARTER</span>
                        @elseif($item->deleted_at != null)
                            <span class="ml-2 badge badge-danger">ACCOUNT IS DELETED</span>
                        @elseif($item->role == 'admin')
                            <span class="ml-2 badge badge-info">ADMIN</span>
                        @endif
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="comment">{{ $item->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @endforeach
        </div>
        <hr>
        <h4>Reply</h4>
        {{-- <form method="post" action="{{ route('comments.store') }}" id="commentForm"> --}}
        <form method="post" action="" id="commentForm">
            @csrf
            <div class="form-group">
                <textarea class="form-control shad" name="content"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-shad" value="Reply" />
            </div>
        </form>
    </div>
</div>
@endsection
@section('sidebar')
<br>
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
                    </div><br>
                    <div class="col-md-8">
                        <p class="small" id="artikel">{{ Str::words($item->content, 30, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row align-items-start">
                </div>
            </div>
        </div>
        <br><hr>
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
                        <p class="small" id="artikel">{{ Str::words($item->content, 30, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
        <br><hr>
        @endforeach
                    </div>
                </div>
            </div>
    </div>
</div>
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
<br>
@endsection
</div>
@section('js')
<script type="text/javascript">
$(function() {
    var artikel = $('#artikel').text();

    // Ubah kurung kotak jadi kurung lancip di artikel
    var ar = artikel.replace(/[[]/g,'<');
    var ar0 = ar.replace(/[\]]/g,'>');
    var ar1 = ar0.replace(/<script>|<\/script>/,':)');

    $('#artikel').html(ar1);
    $('p.comment').each(function(key, value){
        var comments = value.textContent;
        var ct = comments.replace(/[[]/g,'<');
        var ct0 = ct.replace(/[\]]/g,'>');
        var ct1 = ct0.replace(/<script>|<\/script>/,':)');
        $(this).html(ct1);
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#commentForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            data: $('#commentForm').serialize(),
            url: "{{ route('comments.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $('#commentForm').trigger("reset");

                var threadStarter = "{{ $post->user->username }}";
                var badge = '';
                // console.log(data.user.username);
                if (threadStarter == data.user.username) {
                    var badge = '<span class="ml-2 badge badge-success">THREAD STARTER</span>';
                }else if (data.user.role == 'admin') {
                    var badge = '<span class="ml-2 badge badge-info">ADMIN</span>';
                }else if(data.user.deleted_at != null) {
                    var badge = '<span class="ml-2 badge badge-danger">ACCOUNT IS DELETED</span>';
                }

                // Ubah kurung kotak jadi kurung lancip di comment
                var ct = data.content.replace(/[[]/g,'<');
                var ct0 = ct.replace(/[\]]/g,'>');
                var ct1 = ct0.replace(/<script>|<\/script>/,':)');

                $('#commentBody').append(
                        '<div class="row"><div class="col-md-12"><div class="card w-100">'+
                        '<div class="card-header">'+'<i class="fas fa-arrow-right"></i> '+
                        '<a href="/profile/'+data.user.username+'">'+
                        '<strong>'+data.user.username+'</strong>'+badge+'</a>'+
                        '</div><div class="card-body">'+
                        '<p class="comment">'+ct1+'</p>'+
                        '</div></div></div></div><br>'
                );
            },
            error: function(err) {
                // console.log(err.responseJSON.errors);
                $.each(err.responseJSON.errors, function (key, value) {
                    alert(value);
                });
            }
        });
    });
});

</script>
@endsection