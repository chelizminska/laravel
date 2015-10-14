@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <div class="message">
            <form method="post" action="/admin/contents/news/edit">
                <input type="hidden" name="id" value="{{ $news->id }}">
                <input type="text" name="title" value="{{ $news->title }}"><br>
                <textarea name="content" rows="20" cols="70" placeholder="Контент">{{ $news->content }}</textarea><br>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    </div>
@endsection