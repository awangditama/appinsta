<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Commentar;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $relations = ([
            'userto'
        ]);

        $post = Post::with(
            $relations
        )->get();

        $relations = ([
            'userto'
        ]);
        
        $commentar = DB::table('posts')
            ->leftJoin('commentars', 'commentars.post_id', '=', 'posts.id')
            ->leftJoin('users', 'users.id', '=', 'commentars.user_id')
            ->select(DB::raw('posts.id, posts.content, posts.image,group_concat(commentars.comment) as comment, 
            group_concat(users.name) as user_name'))
            ->groupBy('posts.id')
            ->get();

        $likes = DB::table('posts')
            ->leftJoin('likes', 'likes.post_id', '=', 'posts.id')
            ->leftJoin('users', 'users.id', '=', 'likes.user_id')
            ->select(DB::raw('count(likes.like) as likes,posts.id, posts.content, posts.image,
            group_concat(likes.user_id) as user_likes,group_concat(likes.id) as id_likes'))
            ->groupBy('posts.id')
            ->get();

        $user = auth()->user()->id;
        return view('user.dashboard', ['post' => $post, 'info' => $commentar, 'user_session' => $user, 'like' => $likes]);
    }

    public function commentar($id)
    {
        $dataPost = Post::where([
            'id' => $id
        ])->first();

        $dataName = User::where([
            'id' => $dataPost->user_id
        ])->first();

        $relations = ([
            'userto'
        ]);

        $dataCommentar = Commentar::with(
            $relations
        )->where(['post_id' => $id])->get();


        return view('user.post-commentar', [
            'post' => $dataPost,
            'name' => $dataName,
            'commentar' => $dataCommentar
        ]);
    }

    public function create_commentar(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'comment' => 'required'
        ]);

        $data['post_id'] = $id;
        $data['user_id'] = auth()->user()->id;

        if (Commentar::create($data)) {
            return back();
        } else {
            return back()->withInput();
        }
    }

    public function like(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['post_id'] = $id;
        $data['user_id'] = auth()->user()->id;
        $data['like'] = 1;

        if (Like::create($data)) {
            return back();
        }
    }

    public function unlike(Request $request, $id)
    {
        $data = $request->except('_token');
        $id = $id;
        $user = auth()->user()->id;

        if (Like::where(['user_id' => $user, 'post_id' => $id])->delete()) {
            return back();
        }
    }


    /* 
    Testing API
    Example @get All Post Content
    */

    public function getAllPost(){
        return response()->json(Post::All(),200);
    }
}
