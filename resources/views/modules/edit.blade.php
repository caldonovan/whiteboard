@extends('layouts.app')

@section('content')
    <h1>Edit Module</h1>
    {!! Form::open(['action' => ['ModulesController@update', $module->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $module->name, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $module->description, ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'editor'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection