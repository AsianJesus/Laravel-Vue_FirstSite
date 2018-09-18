<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Article;
use App\Comment;
use App\Like;
use App\User;

class ArticlesController extends Controller
{

    public function create(Request $request){
        $article = new Article;
        $article->uid = Auth::id();
        $article->text = $request->post('text');
        $article->title = $request->post('title');

        $article->save();
        return redirect('/article/'.(string)$article->id);
    }
    public function delete($id){

    }
    public function show($id){
        $article = Article::find($id);
        $user = User::find($article['uid']);

        $text = $article['text'];
        $title = $article['title'];
        $comments = DB::select(DB::raw('select users.name, users.id as uid, comments.id,  comments.text, 
(SELECT COUNT(*) FROM likes
 WHERE like_type = 2 and object_id = comments.id) as likes
 from comments join users on users.id = comments.user_id;'));
        $likes = Like::where(['like_type'=>1,'object_id'=>$id])->count();
        $liked = Like::where(['like_type'=>1,'object_id'=>$id,'user_id'=>Auth::id()])->get();
        $liked = $liked == null ? false : true;
        return view('article',[
            'text'=>$text,
            'title'=>$title,
            'id'=>$id,
            'comments'=>$comments,
            'liked'=>$liked,
            'like_count'=>$likes,
            'author'=>$user['name'],
            'uid'=>$user['id']
            ]);
    }
    public function edit(Request $request,$id){
        $article = Article::find($id);
        if($article->uid != Auth::id() && Auth::user()->type == 0){
            return Response('You are not allowed to be here', 550);
        }
        $article->text = $request->post('text');
        $article->title = $request->post('title');
        $article->save();
        return redirect('/');
    }
    public function showEdit($id){
        $article = Article::find($id);
        if($article->uid != Auth::id() && Auth::user()->type == 0){
            return Response('You are not allowed to be here', 550);
        }
        return view('article_edit',[
           'title' => $article->title,
            'text' => $article->text
        ]);
    }
}
