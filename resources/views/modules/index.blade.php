@extends('layouts.app')

@section('content')
    <h1>Modules</h1>
    @if(count($modules) > 1)
        @foreach($modules as $module)
            <div class="card my-3">
                <div class="card-body">
                <h3><a href="/modules/"></a>{{$module->name}}</h3>
                <small>{{$module->description}}</small>
            </div>
            </div>
        @endforeach
    @else
        <p>No Modules Found!</p>
    @endif
@endsection