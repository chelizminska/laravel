@extends('base.layout')
@section('content')
    <div>
        {{ $news->title }}
    </div>
    <div>
        {!! $news->content !!}
    </div>
@endsection