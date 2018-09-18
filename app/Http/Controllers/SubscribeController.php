<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscription;

class SubscribeController extends Controller
{
    public function subscribe(Request $request,$id)
    {
        $my_id = Auth::id();
        if($my_id == $id){
            return response('You can\'t subscribe on yourself!', 303);
        }
        if(Subscription::where(['follower_id'=>$my_id,'subscription_id'=>$id])->first() != null){
            return response("User is already subscribed",403);
        }
        $sub = new Subscription;
        $sub->follower_id=$my_id;
        $sub->subscription_id=$id;
        $sub->save();
    	return response("Successfully subscribed",200);
    }
    public function unsubscribe(Request $request, $id){
        $my_id = Auth::id();
        $sub = Subscription::where(['follower_id'=>$my_id,'subscription_id'=>$id])->firstOrFail();
        $sub->delete();
        return response("Successfulsly unsubscribed",200);
    }

}
