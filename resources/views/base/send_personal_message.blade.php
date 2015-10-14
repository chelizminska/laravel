@extends('base.layout')
@section('content')
    @foreach( $errors->all() as $error)
        <div class="error">
            {{ $error }}
        </div>
    @endforeach
    <form action="/send_message_to_user" method="post">
        Кому: <input type="text" name="dest_user_name" @if(isset($dest_user))value="{{ $dest_user->user_name }} " @endif placeholder="Имя рользователя">
        <br>
        Текст сообщения: <textarea name="content" cols="20" rows="15"></textarea>
        <input type="submit" value="Отправить сообщение.">
    </form>
@endsection