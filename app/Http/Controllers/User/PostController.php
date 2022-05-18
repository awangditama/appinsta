<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Commentar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    //
    public function index()
    {
        $id = auth()->user()->id;

        $post = Post::where([
            'user_id' => $id
        ])->get();

        return view('user.view-post', ['post' => $post]);
    }

    public function create()
    {
        return view('user.create-post');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'content' => 'required|max:255',
            'image' => 'required|image'
        ]);

        $image = $request->image;

        $originalImageName = $image->getClientOriginalName();

        $image->storeAs('public/thumbnail', $originalImageName);

        $data['image'] = $originalImageName;
        $data['user_id'] = $request->user_id;

        if (Post::create($data)) {
            return redirect()->route('user.view-post')->with('success', "Your Post created successfull");
        } else {
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $post = Post::where(['id' => $id])->first();

        return view('user.edit-post', [
            'post' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'content' => 'required|max:255',
            'image' => 'required|image'
        ]);
        
        $post = Post::find($id);

        if ($post->image) {
            $image = $request->image;

            $originalImageName = Str::random(10).$image->getClientOriginalName();

            $image->storeAs('public/thumbnail', $originalImageName);
            Storage::delete('public/thumbnail/' . $post->image);
            
            $data['image'] = $originalImageName;
            $data['user_id'] = $request->user_id;

            
        }

        $post->Update($data);

        return redirect()->route('user.view-post')->with('success', 'Update Post Successfull');
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('user.view-post')->with('success','Delete Post Successfull');
    }
}
