@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <form method="post" action="/admin/contents/forum/{{ $parent_page->id }}/new_topic">
            <input type="text" name="title" placeholder="Название раздела"><br>
            <input type="hidden" name="parent_page_id" value="{{ $parent_page->id }}">
            <!-- <textarea name="content" rows="20" cols="70" placeholder="Текст сообщения"></textarea><br>-->
            <input type="submit" value="Создать раздел">
        </form>
    </div>
@endsection