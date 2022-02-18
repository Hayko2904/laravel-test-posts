@extends('layoute.app')

@section('title')
    Registration
@endsection

@section('content')
    <ol class="list-group list-group-numbered">
        @foreach($users as $user)
            <form action="{{ route('upload', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="file" type="file" class="form-control" alt="">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}" class="img-thumbnail" width="100" height="100">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $user->name }}</div>
                        {{ $user->email }}
                        <div class="fw-bold"><span>Phone: </span>{{ $user->phone }}</div>
                        <div class="fw-bold"><span>Role: {{ $user->role }}</span></div>
                    </div>
                    <button class="badge bg-primary rounded-pill">Save</button>
                </li>
            </form>
        @endforeach
    </ol>
@endsection
