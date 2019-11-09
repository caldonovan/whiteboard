@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
                <a href="/posts" class="btn btn-primary mr-auto">Back</a>
        </div>
        <small>Posted on {{$post->created_at}}</small>
        <div class="card mb-4">
            <div class="card-header text-center my-auto">
                    <h1 class=" ">{{$post->title}}</h1>
            </div>
            <div class="card-body">
                    {!!$post->body!!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
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
                        <p><b>{{ $comment->user->name }} | {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y')}} at {{ \Carbon\Carbon::parse($comment->created_at)->format('H:m:s')}}</b></p>
                        <p>{!! $comment->body !!}</p>
                        <hr>
                    @empty
                        <p>This post has no comments</p>
                    @endforelse
            </div>
        </div>
        

        
    
@endsection