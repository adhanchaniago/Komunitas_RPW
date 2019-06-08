@extends('template.app')
@section('content')
<br>
<div class="table-responsive card">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
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

    var table = $('#data-table').DataTable({
        ajax: {
            url: "{{ route('user.index') }}",
            dataSrc: ''
        },
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'username'},
            {
                data: 'role',
                render: function(data) {
                    if (data == 'member') {
                        var badge = 'btn-info';
                    }else {
                        var badge = 'btn-success';
                    }
                    return '<p class="btn '+badge+'">'+data+'<p>';
                }
            }
        ]
    });
});
</script>
@endsection
