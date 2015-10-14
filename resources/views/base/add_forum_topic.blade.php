@extends('base.layout')
@section('content')
    <div class="content_editing">
        <form method="post" action="/forum/{{ $parent_page->id }}/newtopic">
            <input type="text" name="title" placeholder="Название темы"><br>
            <input type="hidden" name="parent_page_id" value="{{ $parent_page->id }}">
            <textarea name="content" rows="20" cols="70" placeholder="Текст сообщения"></textarea><br>
            <input type="submit" value="Создать тему">
        </form>
    </div>
@endsection