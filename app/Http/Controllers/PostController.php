<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function index(){

        $posts = auth()->user()->posts()->paginate(1);
        return view('admin.posts.index', compact('posts'));
    }
    public function show(Post $post){

        return view('blog-post', compact('post'));
    }
    public function create(){
        return view('admin.posts.create');
    }
    public function store(){

     
        $inputs=request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body' => 'required'
        ]);
        if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
        }
           auth()->user()->posts()->create($inputs);
           session()->flash('post-created-message','Post was Created');
           return redirect()->route('post.index');
    }
    public function edit(Post $post){
        $this->authorize('view',$post);
        return view('admin.posts.edit', compact('post'));
    }
    public function destroy(Post $post){
        
        $post->delete();
        session()->flash('message','Post was deleted');
        return back();
    }
    public function update(Post $post){
        $inputs=request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body' => 'required'
        ]);
        if(request('post_image')){
           $post->post_image = request('post_image')->store('images');
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        auth()->user()->posts()->save($post);
        // $post->save();
        // $post->update();

        session()->flash('post-updated-message','Post was Updated');
        return redirect()->route('post.index');
    }
}
