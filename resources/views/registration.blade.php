@extends('layoute.app')

@section('title')
    Registration
@endsection

@section('content')
    <div class="form-group w-50 mx-auto">
        <h1 class="card-header text-muted">Registration</h1>
        <form method="post" action="{{ route('auth.registration') }}">
            @csrf
            <label class="form-control" for="name">
                <input class="form-control" type="text" id="name" name="name" placeholder="name">
            </label>
            <label class="form-control" for="email">
                <input class="form-control" type="text" id="email" name="email" placeholder="email">
            </label>
            <label class="form-control" for="phone">
                <input class="form-control" type="number" id="phone" name="phone" pattern="[0-9]+" placeholder="phone number">
            </label>
            <label class="form-control" for="password">
                <input class="form-control" type="password" id="password" name="password" placeholder="password">
            </label><label class="form-control" for="password_confirmation">
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="password confirmation">
            </label>

            <button class="btn btn-success w-100">Registration</button>
        </form>
    </div>
@endsection
