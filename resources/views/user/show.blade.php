@extends('template.app')
<div class="container">
    @section('content')
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($errors->any())
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
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card w-100">
                <div class="card-header">
                    My Status
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($user['username'] == Auth::user()['username'])
                            <div class="col-10">
                                <input type="text" name="status" value="{{ $user->statuses == null ? '' : $user->statuses->status }}" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-info">Update</a>
                            </div>
                        @else
                            <div class="col-12">
                                <input type="text" name="status" value="{{ $user->statuses == null ? '' : $user->statuses->status }}" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" disabled>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="tabbable" id="tabs-153735">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active text-dark" href="#tab1" data-toggle="tab">My Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#tab2" data-toggle="tab">My Reply</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#tab3" data-toggle="tab">My Community</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                
            </div>
            <div class="tab-pane" id="tab2">

            </div>
            <div class="tab-pane" id="tab3">
                
            </div>
        </div>
    </div>
    @endsection
    @section('sidebar')
    <br>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('users.update',$user['username']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-title text-center">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="username" class="col-form-label text-md-right">{{ __('Username') }}</label>
                            </div>
                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" required value="{{ old('username') ? old('username') : $user['username'] }}" {{ $user['username'] != Auth::user()->username ? 'disabled':'' }}>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="avatar" class="col-form-label text-md-right">{{ __('Avatar') }}</label>
                                </div>
                                <div class="col-md-12">
                                    <img src="{{asset('storage/'.$user['avatar'])}}" class="img-thumbnail img-fluid"alt="">
                                    @if($user['username'] == Auth::user()->username)
                                    <div class="custom-file">
                                        <label for="avatar" class="custom-file-label">Avatar</label>
                                        <input type="file" class="custom-file-input {{$errors->first('avatar') ? "is-invalid": ""}}" name="avatar" id="avatar" value="{{ old('avatar') ? old('avatar') : $user['avatar'] }}">
                                        <div class="invalid-feedback">
                                            {{$errors->first('avatar')}}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>
                            </div>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required value="{{ old('email') ? old('email') : $user['email'] }}" {{ $user['username'] != Auth::user()->username ? 'disabled':'' }}>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12 text-center">
                            @if($user['username'] == Auth::user()->username)
                            <button type="submit" class="btn btn-outline-success" >Update</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    @if($user['username'] == Auth::user()->username)
    <div class="row">
        <div class="col-12">
            <div id="card-780788">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="card-link" data-toggle="collapse" data-parent="#card-780788" href="#card-element-473299">Change Password</a>
                    </div>
                    <div id="card-element-473299" class="collapse">
                        <form action="{{ route('users.changePassword',$user['username']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>
                                </div>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>
                                </div>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                    Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <br>
    @endsection
</div>