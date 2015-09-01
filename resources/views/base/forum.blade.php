@extends('base.layout')
@section('content')
    <div class="forum_topics">
        @if(isset($topics))
        @foreach($topics as $topic)
            <a href="{{$topic->href}}">{{$topic->title}}</a>
            <br>
        @endforeach
        @endif
    </div>
@endsection