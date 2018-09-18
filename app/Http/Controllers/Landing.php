<?php

namespace App\Http\Controllers;
use App\Subscription;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Like;
use App\Comment;
class Landing extends Controller
{
    public function index(Request $request){
        $users = User::all()->take(20);
        if(Auth::check()){
            $my_articles = Article::where(['uid'=>Auth::id()])
                ->get()->toArray();
            $sub_articles = Subscription::where('follower_id',Auth::id())
                ->join('users','users.id','=','subscriptions.subscription_id')
                ->rightJoin('articles','articles.uid','=','subscriptions.subscription_id')
                ->select('articles.title', 'articles.text','articles.id','users.name','users.id as uid')
                ->orderBy('articles.created_at')
                ->take(20)->get()->toArray();
            $subs = Subscription::where('follower_id',Auth::id())
                ->select('subscription_id as id')->get()->toArray();
            $comments = Comment::all();
            $recents = Article::where([])->orderBy('articles.created_at','desc')
                ->take(20)
                ->join('users','users.id','=','articles.uid')
                ->select('articles.text','articles.title','articles.id','users.name as name','users.id as uid')
                ->orderBy('articles.created_at')
                ->get()->toArray();
            return view('landing',[
                'users'=>$users,
                'admin'=>Auth::user()->type != 0,
                'my_articles'=>$my_articles,
                'subs'=>$subs,
                'sub_articles'=>$sub_articles,
                'comments'=>$comments,
                'recents'=>$recents
            ]);
        }
        else{
            $recents = Article::where([])->orderBy('articles.created_at','desc')
                ->take(20)
                ->join('users','users.id','=','articles.uid')
                ->select('articles.text','articles.title','articles.id','users.name as name','users.id as uid')
                ->get()->toArray();
            return view('landing',['users'=>$users,'admin'=>false,'recents'=>$recents]);
        }

    }
    public function show(){

    }
}
