@extends('base.layout')
@section('content')
    <div>
        <form action="/personal_info_save?user_id={{ $user->id }}" method="post">
            <input type="text" name="user_name" placeholder="username" value="{{ $user->name }}">
            <input type="submit" value="Внести изменения">
        </form>
    </div>
@endsection