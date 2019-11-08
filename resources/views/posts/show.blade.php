@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
                <a href="/posts" class="btn btn-primary mr-auto">Back</a>
        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger ml-2'])}}
        {!!Form::close()!!}
        </div>
        <div class="card mb-4">
            <div class="card-body">
                    <h1>{{$post->title}}</h1>
                    {!!$post->body!!}
            </div>
        </div>
        <small>Posted on {{$post->created_at}}</small>
    
@endsection