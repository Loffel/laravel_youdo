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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $previousPost = Post::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextPost = Post::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return view('posts.show', array('post' => $post, 'previousPost' => $previousPost, 'nextPost' => $nextPost));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if(Auth::user()->id != $post->user_id) redirect()->back();

        return view('posts.edit', array('post' => $post));
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
        $post = Post::findOrFail($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('posts.index');
    }
}
