@extends('admin.layout')
@section('content')
    <div class="content_editing">
        {{ $user->user_name }}<br>
        {{ $user->email }}<br>
        {{ $user->messages_amount }}<br>
        @foreach($messages as $message)
            {{ $message->content }}<br>
        @endforeach
        @if(! $user->isAdmin)
            <form action="/admin/users/{{ $user->id }}/giveWarning" method="post">
                Степень нарушения:<br>
                <select name="points" size="1">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <input type="submit" value="Выдать предупреждение пользователю.">
            </form>
        @endif
    </div>
@endsection