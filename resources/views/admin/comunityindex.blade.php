@extends('template.app')
@section('content')
<br>
<div class="card col-md-6">
            <a class="btn btn-outline-dark" href="{{ route('community.create') }}">
                <span data-feather="plus-circle"></span>
                Tambah<span class="sr-only">(current)</span>
            </a>
        </div><br>
<div class="table-responsive card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Follower</th>
                    <th scope="col">Banner</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comunity as $user)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $user->type }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->followers }}</td>
                    <td><img src="{{ asset('storage/'.$user->banner) }}" alt="" width="80px"></td>
                    <td>
                        <a class="btn-sm btn-primary" href="{{ route('community.show',$user->id) }}">
                            <span data-feather="eye"></span>
                            Detail <span class="sr-only">(current)</span></a>
                            <a class="btn-sm btn-success d-inline" href="{{
                                route('community.edit',$user->id) }}">
                                <span data-feather="edit-3"></span>
                                Edit <span class="sr-only">(current)</span></a>
                                <form class="d-inline"
                                    onsubmit="return confirm('Delete this user permanently?')"
                                    action="{{route('community.destroy', $user->id)}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger" value="Delete">
                                    <span data-feather="trash"></span>
                                    Delete <span class="sr-only">(current)</span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br>
            <div class="row justify-content-center card">
                {{ $comunity->links() }}
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