<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PostView extends Model
{
    // * Logs the users information when viewing a post
    public static function createViewLog($post) {

        // TODO: Logic for checking if guest!
        // Get user ID and post ID
        $uid = auth()->user()->id;
        $pid = $post->id;

        // dd("User ID: ".$uid. " | Post ID: ".$pid);

        $isUnique = DB::table('post_views')->where([
            ['user_id', '=', $uid],
            ['post_id', '=', $pid]
        ])->doesntExist();

        if($isUnique) {
            $pv = new PostView();
            $pv->post_id = $post->id;
            $pv->url = \Request::url();
            $pv->session_id = \Request::getSession()->getId();
            $pv->user_id = (Auth::check()) ? Auth::id():null;
            $pv->ip = \Request::getClientIp();
            $pv->agent = \Request::header('User-Agent');
            $pv->save();
        }
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
