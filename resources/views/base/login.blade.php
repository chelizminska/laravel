@extends('base.layout')
@section('content')
    @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
    <div class="login">
        <form action="/login" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Войти">
        </form>
    </div>
@endsection