@extends('admin.layout')
@section('content')
    @if(! $parent->is_sheet && $parent->is_protected)
        <div class="adding">
            <a href="/admin/contents/forum/{{ $parent->id }}/new_topic">Добавить новый раздел</a>
        </div>
    @endif
    <div class="content_editing">
        @foreach ($childs as $child)
            <a href="/admin/contents/forum/{{ $child->id }}">{{ $child->title }}</a>
            <a onclick="return confirm('Вы дейтвительно хотите удалить данный раздел/тему? Все вложенные сообщения будут утеряны!')" href="/admin/contents/forum/{{ $child->id }}/delete">{{ $child->is_sheet ? "Удалить тему" : "Удалить раздел"}}</a><br>
        @endforeach
    </div>
    <br>
    Последние сообщения
    <div>
        @if($page_number > 1)
            <a href="/admin/contents/forum?page_number={{ $page_number - 1 }}">{{ $page_number - 1 }}</a> ..
        @endif
        {{$page_number}}
        @if($page_number * 10 < $messages_count)
            .. <a href="/admin/contents/forum?page_number={{ $page_number + 1 }}">{{ $page_number + 1 }}</a>
        @endif
            <br>
        @foreach ($messages as $message)
            <div class="message">
                {{ $message->content }}
            </div>
            <a href="/admin/users/{{ \App\User::where('user_name', '=', $message->user)->first()->id }}">{{ $message->user }}</a><br>
        @endforeach
    </div>
@endsection