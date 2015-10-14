@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <div class="adding">
            <form action="/admin/contents/fishes/delete" method="get">
                <input type="hidden" name="id" value="{{ $fish->id }}">
                <input type="submit" value="Удалить" onclick="return confirm('Вы точно хотите удалить {{ $fish->title }}')">
            </form>
        </div>
        <form method="post" action="/admin/contents/fishes/edit">
            <input type="hidden" name="id" value="{{ $fish->id }}">
            <input type="text" name="title" value="{{ $fish->title }}" placeholder="Рыба"><br>
            <textarea name="content" rows="20" cols="70">{{ $fish->content }}</textarea><br>
            <input type="submit" value="Сохранить">
        </form>
    </div>
@endsection