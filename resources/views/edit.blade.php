@extends('layoute.app')

@section('title')
    Registration
@endsection

@section('content')
    <div class="form-group">
        <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post">
            @csrf
            <label class="form-control" for="title">
                <input id="title" class="form-control" name="title" type="text" value="{{ $post->title }}">
            </label>
            <label class="form-control" for="description">
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea>
            </label>
            <select name="public" class="form-select" aria-label="Default select example">
                <option {{ $post->public ? 'selected' : '' }} value="1">Public</option>
                <option {{ !$post->public ? 'selected' : '' }} value="0">Private</option>
            </select>
            <button class="btn btn-success w-100">Save</button>
        </form>
    </div>
@endsection
