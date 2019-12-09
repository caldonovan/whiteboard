@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/data']) !!}
        <div class="form-group">
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body', 'id' => 'editor'])}}
        </div>
        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        <div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection