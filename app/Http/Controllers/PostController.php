<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('pages.home', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'users_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('msg', 'Poszt létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::where('users_id', auth()->user()->id)->get();

        if(auth()->user()->id != $id) {
            return redirect()->route('home');
        }

        return view('pages.myposts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->get()->first();
        return view('pages.edit-post', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $request->validated();

        Post::where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->back()->with('msg', 'Sikeres módosítás!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return redirect()->route('myposts', auth()->user()->id)->with('msg', 'Bejegyzés törölve!');
    }
}
