@extends('layouts.app')

@section('content')
        <div class="row mb-5 mx-0">
                <a href="/posts" class="btn btn-primary mr-auto">Back</a>
        </div>
        <small>Posted on {{$post->created_at}} | Author: <b>{{ $user->name }}</b></small>
        <div class="card mb-4">
            <div class="card-header text-center my-auto">
                    <h1>{{$post->title}}</h1>
            </div>
            <div class="card-body">
                    {!!$post->body!!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <comments user-id={{ $user->id }} bearer-token={{ $token }} post-id="{{ $post->id }}"></comments>
            </div>
        </div>
@endsection