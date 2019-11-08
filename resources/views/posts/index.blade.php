@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <a href="/posts/{{$post->id}}" class="card my-3 hvr-grow">
                <div class="card-body">
                <h3>{{$post->title}}</h3>
                <small>Posted on {{$post->created_at}} | {{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</small>
            </div>
            </a>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found!</p>
    @endif
@endsection