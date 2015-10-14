@extends('base.layout')
@section('content')
    @foreach ($news as $n)
        <div>
            <a href="/view_news?id={{ $n->id }}">{{ $n->title }}</a>
        </div>
    @endforeach
@endsection