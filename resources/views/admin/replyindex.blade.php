@extends('template.app')
@section('content')
<br>
<div class="table-responsive card">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Reply</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                    </tbody>
                </table>
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
@endsection
@section('js')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('p.artikel').each(function(key, value){
        var artikel = value.textContent;
        var ct = artikel.replace(/[[]/g,'<');
        var ct0 = ct.replace(/[\]]/g,'>');
        var ct1 = ct0.replace(/<script>|<\/script>/,':)');
        $(this).html(ct1);
    })

    var table = $('#data-table').DataTable({
        ajax: {
            url: "{{ route('reply.index') }}",
            dataSrc: ''
        },
        columns: [
            {data: 'id'},
            {data: 'user.username'},
            {
                data: 'content',
                render: function(data) {
                    var str = data;
                    return '<p class="artikel">'+str.substr(0,50)+' ...</p>';
                }
            },
            {
                data: 'post.title',
                render: function(data) {
                    return '<a href="/posts/'+data+'">'+data+'</a>'
                }
            },
            {
                data: 'id',
                render: function(id) {
                    var btn = '<a href="javascript:void(0)" class="btn btn-danger w-100 hapus" data-id="'+id+'"><i class="fas fa-trash mr-2"></i>Hapus</a>';
                    return btn;
                }
            }
        ]
    });

    $('body').on('click','.hapus', function () {
        var post = $(this).data("id");
        var x = confirm("Apakah anda yakin ingin menghapus data ini !");
        if (x) {
            $.ajax({
                type: "DELETE",
                url: '/admin/reply/'+post+'/delete',
                success: function () {
                    table.ajax.reload();
                    $('#success-massage').html('<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">'+'<strong>Data berhasil dihapus</strong>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span></button></div>');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
</script>
@endsection
