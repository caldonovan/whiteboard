@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
                <a href="/posts" class="btn btn-primary mr-auto">Back</a>
        </div>
        <small>Posted on {{$post->created_at}} | Posted by: <b>{{ $author }}</b></small>
        <div class="card mb-4">
            <div class="card-header text-center my-auto">
                    <h1>{{$post->title}}</h1>
            </div>
            <div class="card-body">
                    {!!$post->body!!}
            </div>
            <div class="card-footer">
                <div class="container">
                    <div class="row">
                        <img class="img-fluid" src="/storage/images/{{$post->image}}" alt="Attached Image" onerror="this.src='https://fakeimg.pl/350x200/?text=Image&font=lobster'">
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-body">
                @if(!is_null($user))
                    <comments user-id={{ $user->id }} bearer-token={{ $token }} post-id="{{ $post->id }}"></comments>
                @else
                    <p>You are not logged in!</p>
                @endif
            </div>
        </div>
@endsection