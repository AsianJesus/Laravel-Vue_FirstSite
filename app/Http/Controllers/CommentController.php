<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function add(Request $request){
        $comment = new Comment;
        $comment['article_id'] = $request->post('article_id');
        $comment['user_id'] = $request->post('uid');
        $comment['text'] = $request->post('text');
        $comment->save();
        return redirect()->back();
    }
    public function delete($id){
        $comment = Comment::where(['id'=>$id])->firstOrFail();
        $comment->delete();
    }
    public function edit($id){

    }
    public function show($id){

    }
    public function show_by_user($uid){

    }
    public function show_by_article($article_id){

    }
}
