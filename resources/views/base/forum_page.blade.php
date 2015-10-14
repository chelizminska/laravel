@extends('base.layout')
@section('content')
    <div class="forum_page">
        @if($page_number > 1)
            <a href="/forum/{{ $page_id }}?page_number={{$page_number - 1}}">{{ $page_number - 1 }}</a> ..
        @endif
        {{$page_number}}
        @if($page_number * 3 < $messages_count)
            .. <a href="/forum/{{ $page_id }}?page_number={{$page_number + 1}}">{{ $page_number + 1 }}</a>
        @endif
        @foreach($messages as $message)
            <div class="message_block">
                <div class="message_describer">
                    <h4>
                        Сообщение от: <a href="/user?id={{ \App\User::where('user_name', '=', $message->user)->first()->id }}">
                            {{ \App\User::where('user_name', '=', $message->user)->first()->user_name }}</a><br>
                        {{ $message->created_at }}
                        Сообщений на форуме: {{ \App\User::where('user_name', '=', $message->user)->first()->messages_amount }}<br>
                    </h4>
                </div>
                <div class="message">
                    {{ $message->content }}ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
                </div>
            </div>
        @endforeach
        @if($page_number * 3 >= $messages_count)
            <div class="send_forum_message_form">
                @if(!Auth::guest())
                    <form method="post" action="/forum/{{ $page_id }}/add">
                        <textarea name="message_content" rows="8" cols="40"></textarea>
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="title" value="{{ $page_title }}">
                        <input type="hidden" name="user" value="{{ Auth::getUser()['user_name'] }}">
                        @if($page_number * 3 == $messages_count)
                            <input type="hidden" name="page_number" value="{{ $page_number + 1 }}">
                        @else
                            <input type="hidden" name="page_number" value="{{ $page_number }}">
                        @endif
                        <br>
                        <input type="submit" value="Отправить">
                    </form>
                @else
                    <div class="blocked">
                        Незарегистрированные пользователи не мгут оставлять сообщения.
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection