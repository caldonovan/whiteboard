@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
                <a href="/posts" class="btn btn-primary mr-auto">Back</a>
        </div>
        <small>Posted on {{$post->created_at}}</small>
        <div class="card mb-4">
            <div class="card-body">
                    <h1>{{$post->title}}</h1>
                    {!!$post->body!!}
            </div>
        </div>
        @if(Auth::check())
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('comment', 'Comment')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Comment', 'id' => 'editor'])}}
            </div>
            {{Form::hidden('post_id', $post->id)}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        @endif
        @forelse ($post->comments as $comment)
            <p>{{ $comment->user->name }} | {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y')}} at {{ \Carbon\Carbon::parse($comment->created_at)->format('H:m:s')}}</p>
            <p>{!! $comment->body !!}</p>
            <hr>
        @empty
            <p>This post has no comments</p>
        @endforelse

        
    
@endsection