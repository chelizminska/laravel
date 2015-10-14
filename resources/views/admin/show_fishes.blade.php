@extends('admin.layout')
@section('content')
    <div class="adding">
        <a href="/admin/contents/fishes/add">Добавить</a>
    </div>
    <div class="content_editing">
        @foreach ($fishes as $fish)
            <a href="/admin/contents/fishes/edit?id={{ $fish->id }}">{{ $fish->title }}</a><br>
        @endforeach
    </div>
@endsection