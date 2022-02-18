@extends('layoute.app')

@section('title')
    Registration
@endsection

@section('content')
    <ol class="list-group list-group-numbered">
        @foreach($posts as $post)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $post->title }}</div>
                    {{ $post->description }}
                    <div class="fw-bold"><span>Author: </span>{{ $post->user->name }}</div>
                    <div class="fw-bold"><span>Status: {{ $post->public ? 'public ' : 'private ' }}</span></div>
                </div>
                @if(auth()->user())
                    <a class="badge bg-primary rounded-pill" href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                    <a class="badge bg-primary rounded-pill" href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                @endif
            </li>
        @endforeach
    </ol>
@endsection
