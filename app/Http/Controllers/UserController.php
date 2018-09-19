<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Like;
use App\Subscription;
use App\Article;

class UserController extends Controller
{
    public function delete(Request $request,$id){
        if(Auth::user()->type || Auth::id() == $id){
            $user = User::find($id);
            $user->delete();
            return Response('User is deleted');
        }else {
            return Response('User is not allowed', 403);
        }
    }
    public function show(Request $request,$id){
        if(Auth::check() && Auth::user()->id == $id)
            return redirect('/myprofile');
        $user = User::where(['id'=>$id])->first();
        if($user == null){
            return view('user_page',["exists"=>isset($user)]);
        }
        $articles =Article::where(['uid'=>$id])->get()->toArray();
        $subs = Subscription::where(['subscription_id'=>$id])->count();
        $likes = Article::where('uid',$id)
            ->join('likes','likes.object_id','=','articles.uid')
            ->where('like_type','1')
            ->count();
        $role = $user->type == 1 ? 'Admin' : 'User';
        $subscribed = Subscription::where(['subscription_id'=>$id,'follower_id'=>Auth::id()])->count() != 0;
        return view('user_page',
            ["exists"=>isset($user),
                "name"=>$user->name,
                'articles'=>$articles,
                'likes'=>$likes,
                'subs'=>$subs,
                'role'=>$role,
                'id' => $id,
                'subscribed' =>$subscribed
                ]);
    }
    public function myprofile(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        $articles = Article::where(['uid'=>$id])->get()->toArray();
        $likes = User::where(['users.id'=>$id])
            ->rightJoin('articles','uid','=','users.id')
            ->rightJoin('likes',function($join){
                $join->on('likes.like_type','=',DB::raw(2));
                $join->on('likes.object_id','=','articles.id');
            })->count();
        $subs = Subscription::where(['subscription_id'=>$id])
            ->join('users','users.id','=','subscriptions.follower_id')
            ->select('users.name as name','users.id as id')
            ->get()->toArray();
        $following = Subscription::where(['follower_id'=>$id])
            ->join('users','users.id','=','subscriptions.subscription_id')
            ->select('users.name as name','users.id as id')
            ->get()->toArray();
        $data = array(
            "user"=>$user,
            "articles"=>$articles,
            'total_likes'=>$likes,
            'subs'=>$subs,
            'follows'=>$following
        );
        return view('myprofile',$data);
    }
    public function all(Request $request){
        $users = User::all();
        return view('users_all',['users'=>$users]);
    }
}
