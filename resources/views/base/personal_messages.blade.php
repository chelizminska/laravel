@extends('base.layout')
@section('content')
    <div class="messages">
        @foreach ($messages as $message)
            @if ($message->is_viewed)
                <div class="viewed_message">
            @else
                <div class="non_viewed_message">
            @endif
                    <a href="/personal_message?id={{ $message->id }}">{{ substr($message->content, 0, 20) }}
                        @if (strlen($message->content) > 20) ... @endif
                    </a>
                </div>
        @endforeach
    </div>
@endsection