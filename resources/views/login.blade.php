@extends('layoute.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="form-group w-50 mx-auto">
        <h1 class="card-header text-muted">Login</h1>
        <form method="post" action="{{ route('auth.login') }}">
            @csrf
            <label class="form-control" for="login">
                <input class="form-control" type="text" id="login" name="email" placeholder="email or phone number">
            </label>
            <label class="form-control" for="password">
                <input class="form-control" type="password" id="password" name="password" placeholder="password">
            </label>
            <button class="btn btn-success w-100">Login</button>
        </form>
    </div>
@endsection
