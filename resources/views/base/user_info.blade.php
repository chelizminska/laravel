@extends('base.layout')
@section('content')
    <div>
        {{ $dest_user->user_name }}
    </div>
    <div>
        <a href="/send_message_to_user?id={{ $dest_user->id }}">Отправить сообщение пользователю.</a>
    </div>
@endsection