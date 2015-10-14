@extends('admin.layout')
@section('content')
    <a href="/admin/contents/news/add">Добавить новость</a><br>
    @if($page_number > 1)
        <a href="/admin/contents/news?page_number={{$page_number - 1}}">{{ $page_number - 1 }}</a> ..
    @endif
    {{$page_number}}
    @if($page_number * 10 < $news_count)
        .. <a href="/admin/contents/news?page_number={{$page_number + 1}}">{{ $page_number + 1 }}</a>
    @endif
    @foreach($news as $n)
        <div class="news">
            {{ $n->title }}
            <form action="/admin/contents/news/edit" method="get">
                <input type="hidden" name="id" value="{{ $n->id }}">
                <input type="submit" value="Изменить">
            </form>
            <form action="/admin/contents/news/delete" method="post">
                <input type="hidden" name="id" value="{{ $n->id }}">
                <input type="submit" value="Удалить" onclick="return confirm('Удалить эту новость?')">
            </form>
        </div>
    @endforeach
@endsection