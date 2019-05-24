@extends('template.app')
@section('content')
<br>
<div class="table-responsive card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Avatar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role == "admin" ? 'badge-primary' : 'badge-secondary'}}">{{ $user->role }}</span>
                    </td>
                    <td><img src="{{ asset('storage/'.$user->avatar) }}" alt="" width="80px"></td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br>
            <div class="row justify-content-center card">
                {{ $users->links() }}
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