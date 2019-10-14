<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', array('posts' => $posts));
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
        $coverImage = NULL;
        if($request->hasFile('cover')){
            $coverImage = $request->file('cover')->store('images/blog', 'public');
            $image = Image::make(public_path('storage/'.$coverImage))->fit(800, 500);
            $image->save();
        }

        $post = Post::create(array(
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'cover' => $coverImage
        ));

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        return view('posts.show', array('post' => $post, 'previousPost' => $previousPost, 'nextPost' => $nextPost));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', array('post' => $post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $coverImage = NULL;
        if($request->hasFile('cover')){
            $coverImage = $request->file('cover')->store('images/blog', 'public');
            $image = Image::make(public_path('storage/'.$coverImage))->fit(800, 500);
            $image->save();

            $post->update(array(
                'cover' => $coverImage
            ));
        }

        $post->update(array(
            'title' => $request->title,
            'content' => $request->content
        ));

        return redirect()->route('posts.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
