<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
/*
        foreach ($posts as $post) {
            $post->author = DB::table('users')->where('id', $post->author_id)->value('name');
        }
        */
        // Log::info('posts', ['posts' => $posts]);

        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (Auth::check()) {
            return view('create');
        }
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $this->validate(request(), [
            'title' => 'required|max:100',
            'text' => 'required',
        ]);

        // create new post
        $post = new Post();

        // fill model with data
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->user_id = Auth::id();

        // save to DB
        $post->save();

        return redirect()->route('posts.show', $post->id)->with('info', 'Posted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     */
    public function show($post_id)
    {
        $post = Post::find($post_id);
        // $post->author = DB::table('users')->where('id', $post->user_id)->value('name');

        return view('show', ['post' => $post]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     */
    public function edit($post_id)
    {
        //Retrieve the post
        $post = Post::find($post_id);

        // check policy
        $this->authorize('update', $post);

        // show the edit view
        return view('edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     */
    public function update(Request $request)
    {
        // Retrieve the post
        $post = Post::find($request->input('id'));

        // check policy
        $this->authorize('update', $post);

        $this->validate(request(), [
            'title' => 'required|max:100',
            'text' => 'required',
        ]);

        // update data
        $post->title = $request->input('title');
        $post->text = $request->input('text');

        // save to DB
        $post->save();

        return redirect()->route('posts.show', ['post_id' => $post->id])->with('info', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     */
    public function destroy($id)
    {
        // Retrieve the post
        $post = Post::find($id);

        // check policy
        $this->authorize('delete', $post);

        // delete
        $post->delete();
        return redirect()->route('posts.index');
    }
}
