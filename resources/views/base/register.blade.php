@extends('base.layout')
@section('content')
    @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
    <form action="/register" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password-confirmation" placeholder="password">
        <input type="submit" value="Зарегистрироваться">
    </form>
@endsection