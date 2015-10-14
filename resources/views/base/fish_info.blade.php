@extends('base.layout')

@section('title')
    {{$fish['title']}}|
@endsection

@section('content')
    <div class="fishes">
        <h1>{{ $fish['title']}}</h1>
        {!! $fish['content']!!}
    </div>
@endsection