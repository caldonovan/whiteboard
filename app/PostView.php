<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    // * Logs the users information when viewing a post
    public static function createViewLog($post) {
        $pv = new PostView();
        $pv->post_id = $post->id;
        $pv->url = \Request::url();
        $pv->session_id = \Request::getSession()->getId();
        $pv->user_id = (\Auth::check()) ? \Auth::id():null;
        $pv->ip = \Request::getClientIp();
        $pv->agent = \Request::header('User-Agent');
        $pv->save();
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
