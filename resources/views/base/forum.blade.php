@extends('base.layout')
@section('content')
    <div class="forum_topics">
        @if(Auth::user() and !$parent_page->is_protected)
            <div class="add_topic">
               <a href="/forum/{{ $parent_page->id }}/newtopic">Создать тему</a>
            </div>
        @endif
        @if(isset($topics))
        @foreach($topics as $key => $topic)
            <div class="topic">
                <a href="/forum/{{$topic->id}}?page_number=1">{{$topic->title}}</a>
                @if($topic->is_sheet)
                    <h4>Создатель темы: <a href="/user">{{ $page_messages[$key][0]->user }}</a><br>
                    Всего ответов: {{ sizeof($page_messages[$key]) - 1 }}</h4>
                @else
                    <h4>Тем в разделе: {{ $topic->child_amount }}</h4>
                @endif
            </div>
        @endforeach
        @endif
    </div>
@endsection