@extends('base.layout')
@section('content')
    @foreach ($news as $n)
        <div>
            <a href="/view_news?id={{ $n->id }}">{{ $n->title }}</a>
        </div>
    @endforeach
    <div class="gen_link">
        <a href="/news">Ко всем новостям</a>
    </div>
@endsection