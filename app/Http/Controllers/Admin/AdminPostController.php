<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
class AdminPostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:admin.posts.index')->only('index');
    //     $this->middleware('can:admin.posts.create')->only('create','store');
    //     $this->middleware('can:admin.posts.edit')->only('edit','update');
    //     $this->middleware('can:admin.posts.destroy')->only('destroy');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id');
        $tags=Tag::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $post = Post::create($request->all());
       

        if ($request->file('file')) {
            $url= str_replace('public/','',Storage::put('public/posts', $request->file('file')));
            $post->image()->create([
                'url' => $url
            ]);
        }

       if ($request->tags) {
           $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit',$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
     
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $postss)
    {   
       
        $this->authorize('author',$postss);

        $post=$postss;
        $categories=Category::pluck('name','id');
        $tags=Tag::all();
        return view('admin.posts.edit',compact('postss','post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $postss)
    {
        $this->authorize('author',$postss);
        $postss->update($request->all());
        if ($request->file('file')) {
            $url=str_replace('public/','',Storage::put('public/posts', $request->file('file')));
            if ($postss->image) {
                Storage::delete($postss->image->url);
                $postss->image->update([
                    'url' => $url
                ]);
            }else{
                $postss->image()->create([
                    'url' => $url
                ]);
            }
        }
         if ($request->tags) {
            $postss->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.edit',$postss)->with('info','El post se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $postss)
    {
        $this->authorize('author',$postss);
        $postss->delete();
        return redirect()->route('admin.posts.index')->with('info','El post se elimino correctamente.');
     }
}
