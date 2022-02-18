@extends('layoute.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="form-group">
        <form action="{{ route('upload', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <img src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}" class="img-thumbnail" width="100" height="100">
            <input name="file" type="file" class="form-control" alt="">
            <label class="form-control" for="name">Name
                <input id="name" class="form-control" name="name" type="text" value="{{ $user->name }}">
            </label>
            <button class="btn btn-success w-100">Save</button>
        </form>
    </div>
@endsection
