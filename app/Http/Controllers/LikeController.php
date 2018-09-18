<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
    public function like(Request $request,$type,$id){
        $uid = Auth::id();
        if(Like::where(['like_type'=>$type,'object_id'=>$id,'user_id'=>$uid])->first() != null)
            return Response('You already like this',405);
        $like = new Like;
        $like->like_type = $type;
        $like->object_id = $id;
        $like->user_id = $uid;
        $like->save();
        return Response('Successfully liked',200);
    }
    public function unlike(Request $request, $type, $id){
        $uid = Auth::id();
        $like = Like::where(['like_type'=>$type,'object_id'=>$id,'user_id'=>$uid])->firstOrFail();
        $like->delete();
        return Response('Successfully disliked',200);
    }
}
