<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostView;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Post as PostResource;
use Exception;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {   
        // * Check if user is logged in, except for index and show (post)
        $this->middleware('auth', ['except' => ['apiShow', 'apiIndex', 'index', 'show']]);
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

    public function apiIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        // return PostResource::collection($posts);
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // * Get the currently logged in user
        $user = auth()->user();
        //dd($user);

        // * Check if the user has permissions to create a new post
        if ($user->can('create', Post::class)) {
            return view('posts.create');
        } else {
            return redirect('/posts')->with('error', 'Unauthorized');
        }
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
            'image' => 'image|nullable|max:1999'
        ]);
        // * Upload File
        if($request->hasFile('image')) {
            // * Get file name
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // * Get file name without extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // * Get file extension
            $ext = $request->file('image')->getClientOriginalExtension();
            // * Create filename to store (avoids filename clashing)
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            // * Store file
            $fileNameToStore = str_replace(' ', '', $fileNameToStore);
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpeg';
        }

        // * Create the new post and save to the database
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; // * Grab logged in users 'id' and assign to new post.
        $post->image = $fileNameToStore;
        $post->save();

        return redirect('/posts/'.$post->id)->with('success', 'Post Created');
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
        $author = User::where('id', $post->user_id)->value('name');
        if(Auth::guest()) {
            $user = null;
            $token = null;
        }
        else {
            $user = Auth::user();
            $token = $user->api_token;
        }       
        
        try {
            PostView::createViewLog($post);
        } catch (Exception $e) {
            dd($e);
        } 
        return view('posts.show')->with('post', $post)->with('token', $token)->with('user', $user)->with('author', $author);
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
        if(Auth::user()->id !== $post->user_id){
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
            'body' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        // * Upload File
        if($request->hasFile('image')) {
            // * Get file name
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // * Get file name without extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // * Get file extension
            $ext = $request->file('image')->getClientOriginalExtension();
            // * Create filename to store (avoids filename clashing)
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            // * Store file
            $fileNameToStore = str_replace(' ', '', $fileNameToStore);
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpeg';
        }

        // * Create the new post and save to the database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->image = $fileNameToStore;
        $post->update();

        return redirect('/posts/'.$id)->with('success', 'Post Updated');
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
        if(Auth::user()->id !== $post->user_id){
            return redirect('/home')->with('error', 'Unauthorized');
        }

        $post->delete();
        return redirect('/home')->with('success', 'Post Removed');
    }
}
