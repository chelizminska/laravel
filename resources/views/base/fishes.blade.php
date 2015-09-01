@extends('base.layout')
@section('content')
    <div class="fishes">
        @foreach($fishes as $fish)
            <a href="{{ $fish->href }}">{{ $fish->title }}</a>
            <br>
        @endforeach
    </div>
@endsection