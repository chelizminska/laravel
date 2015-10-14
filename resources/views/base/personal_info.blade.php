@extends('base.layout')
@section('content')
    <div>
        {{ $user->user_name }}
    </div>
    <div>
        {{ $user->email }}
    </div>
    <a href="/personal_info_change?user_id={{ $user->id }}">Изменить личные данные</a>
@endsection