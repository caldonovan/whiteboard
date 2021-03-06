@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
            <a href="/modules/" class="btn btn-primary mr-auto">Back</a>
        </div>
        <div class="card mb-4">
            <div class="card-header my-auto text-center">
                <h1>{{$module->code}}</h1>
            </div>
            <div class="card-body">
                {!!$module->description!!}
            </div>
        </div>
        <div class="card">
            <div class="card-header my-auto text-center">
                <h1>Users Enrolled</h1>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    
@endsection