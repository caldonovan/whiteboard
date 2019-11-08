@extends('layouts.app')

@section('content')
    <h1>Create Module</h1>
    {!! Form::open(['action' => 'ModulesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'editor'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection