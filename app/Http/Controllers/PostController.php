<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function get(Request $request){
        $this->validate($request, [
            'id' => 'required|integer',
        ]);
        try{                        
            $post = Post::findOrFail($request->id);
            return $this->apiResponse(200, 'success', ['post' => $post]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
     }

    public function getAll(){
        try{                        
            $listPost = Post::all();
            return $this->apiResponse(200, 'success', ['post' => $listPost]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }     

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|image',
        ]);
        try{            
            $post = new Post;
            $post->fill($request->all());
            if ($request->hasFile('image')) {
                $imageUrl = $request->title.'-image-'.time().'.'.$request->image->extension();
                $request->file('image')->move(('posts'), $imageUrl);
                $post->image_url = $imageUrl;
            }
            $post->save();
            return $this->apiResponse(200, 'success', ['post' => $post]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }

        
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'image',
        ]);

        try{
            $post = Post::findOrFail($request->id);
            $post->fill($request->all());
            if ($request->hasFile('image')) {
                unlink(('posts/'.$post->image_url));
                $imageUrl = $request->title.'-image-'.time().'.'.$request->image->extension();
                $request->file('image')->move(('posts'), $imageUrl);
                $mahasiswa->image_url = $imageUrl;
            }
            $post->save();
            return $this->apiResponse(200, 'success', ['post' => $post]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }

        
        
    }

    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required|integer',            
        ]);
        try{
            $post = Post::findOrFail($request->id);
            unlink(('posts/'.$post->image_url));
            Post::destroy($request->id);            
            return $this->apiResponse(200, 'success', ['post' => $post]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }                        
    }
}