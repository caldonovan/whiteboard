@extends('layouts.app')

@section('content')
    <h1>Modules</h1>
    @if(count($modules) > 1)
        @foreach($modules as $module)
            <a href="/modules/{{$module->id}}" class="card my-3 hvr-grow">
            <div class="card-body">
                <h3>{{$module->code}}</h3>
                <small>{{$module->description}}</small>
            </div>
            </a>
        @endforeach
        {{$modules->links()}}
    @else
        <p>No Modules Found!</p>
    @endif
@endsection