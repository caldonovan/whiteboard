<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'apiIndex']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Comments
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    public function apiIndex($id) 
    {
        $comments = Comment::where('post_id', $id)->get();
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $post = Post::findOrFail($request->post_id);

        $comment = new Comment;
        $comment -> post_id = $post->id;
        $comment -> user_id = $user_id;
        $comment -> body = $request->body;
        $comment -> save();
        
        $user = User::find($user_id);
        return view('posts.show')->with('post', $post);
    }

    public function apiStore(Request $request) {
        $uid = auth()->user()->id;
        if($uid === null) {
            $uid = 1;
            dump("No UID Found!!");
        }
        $post = Post::findOrFail($request['post_id']);
        $c = new Comment;
        $c -> post_id = $post->id;
        $c -> user_id = $uid;
        $c -> user_name = User::where('id', $uid)->value('name');
        $c -> body = $request->body;
        $c -> save();
        return $c;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function apiUpdate(Request $request, $id)
    {
        $comment = Comment::find($comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function apiDelete($id)
    {

        try {
            $comment = Comment::findOrFail($id);
            if(auth()->user()->id != $comment->user_id) {
                return response()->json("You are not authorized to delete this comment!");
            }
            $comment->delete();
            return response()->json("Comment Deleted");
        }
        catch(Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        //dd($request);
        //$comment = Comment::findOrFail($request->id);
        //if(auth()->user()->id != $comment->id) {
        //    return alert("You are not authorised to delete this comment!");
       // }
        //$comment->delete();
        //dd($comment);
        //return $comment;
    }
}
