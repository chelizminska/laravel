@extends('base.layout')
@section('content')
    <div class="fishes">
        <h1>{{$fish['title']}}</h1>
        {{ $fish['content'] }}
    </div>
@endsection