@extends('base.layout')
@section('content')
    <div class="fishes">
        @foreach($fishes as $fish)
            <a href="/fishes/{{ $fish->id }}">{{ $fish->title }}</a>
            <br>
        @endforeach
    </div>
@endsection