<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $datos = $request->all();
        $datos['user_id'] = auth()->user()->id;

        $post = Post::create($datos);

        if ($request->file('file')){
            $url = Storage::put('posts', $request->file('file'));
        
            $post->image()->create([
                'url' => $url
            ]);
        }
       
        if ($request->tags){
            foreach ($request->tags as $tag) {
                $post->tags()->attach([$tag]);
            }

        };

       return redirect()->route('admin.posts.index')->with('info', 'Post creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $postTags = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags, 'postTags' => $postTags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $datos = $request->all();
        $datos['user_id'] = auth()->user()->id;

        $post->update($datos);

        if ($request->file('file')){
            $url = Storage::put('posts', $request->file('file'));
        
            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
       
        if ($request->tags){
            foreach ($request->tags as $tag) {
                $post->tags()->sync([$tag]);
                
            }
        };

       return redirect()->route('admin.posts.index')->with('info', 'Post creado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        $post->tags()->detach();

        return redirect()->route('admin.posts.index')->with('info', 'Post eliminado exitosamente');
    }
}
