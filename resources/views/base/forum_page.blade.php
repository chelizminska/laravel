@extends('base.layout')
@section('content')
    <div class="forum_messages">
        @if(isset($messages))
            @foreach($messages as $message)
                {{$message->content}}
                <br>
            @endforeach
        @endif
    </div>
@endsection