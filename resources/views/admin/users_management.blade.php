@extends('admin.layout')
@section('content')
    @foreach ($users as $user)
        <div class="content_editing">
            <a href="/admin/users/{{ $user->id }}">{{ $user->user_name }}</a>
        </div>
    @endforeach
@endsection