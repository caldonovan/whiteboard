@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <a href="/posts/{{$post->id}}" class="card my-3 hvr-grow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img class="w-100" src="/storage/images/{{$post->image}}" alt="noimage" onerror="this.src='https://fakeimg.pl/350x200/?text=Post&font=lobster'">
                        </div>
                        <div class="col-md-10">
                            <h3>{{$post->title}}</h3>
                            <small>Posted on {{$post->created_at}} | {{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }} | Views: {{$post->views->count()}}</small>
                        </div>
                    </div>
                    
                </div>
            </a>
        @endforeach
        <div class="row">
            <div class="col-lg-12">
                    {{$posts->links()}}
            </div>       
        </div>        
    @else
        <h1>No Posts Found!</h1>
    @endif
@endsection