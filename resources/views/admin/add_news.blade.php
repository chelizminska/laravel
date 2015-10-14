@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <form method="post" action="/admin/contents/news/add">
            <input type="text" name="title" placeholder="Заголовок новости"><br>
            <textarea name="content" rows="20" cols="70" placeholder="Контент"></textarea><br>
            <input type="submit" value="Опубликовать новость">
        </form>
    </div>
@endsection