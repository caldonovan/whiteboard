@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Dashboard</h5></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>

                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                        <a href="/posts/{{$post->id}}/edit" class="card card-dark my-3 hvr-grow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                            <h3>{{$post->title}}</h3>
                                            <small>Posted on {{$post->created_at}} | Views: {{$post->unique_views}}</small>
                                    </div>
                                    <div class="col-md-2 text-center my-auto">
                                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger ml-2'])}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                
                                
                            </div>
                        </a>
                        @endforeach

                    @else 
                        <p>You have no posts!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
