@extends('layouts.app')

@section('content')
    <h1>Create Module</h1>
    {!! Form::open(['action' => 'ModuleController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('code', 'Module Code')}}
            {{Form::text('code', '', ['class' => 'form-control', 'placeholder' => 'Module Code...'])}}
        </div>
        <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'editor'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection