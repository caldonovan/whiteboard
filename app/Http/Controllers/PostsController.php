<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {   
        // * Check if user is logged in, except for index and show (post)
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // * This ensures the user actually writes something.
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999'
        ]);

        // * Upload File
        if($request->hasFile('conver_image')) {
            // * Get file name
            $filenameWithExt = $request->file('cover_image')->getClientOriginalImage();
            // * Get file name without extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // * Get file extension
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            // * Create filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            // * Store file
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpeg';
        }

        // * Create the new post and save to the database
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; // * Grab logged in users 'id' and assign to new post.
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // * Check if user is logged in & has authorization to edit post
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // * This ensures the user actually writes something.
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // * Create the new post and save to the database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // * Check if user is logged in & has authorization to edit post
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized');
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
