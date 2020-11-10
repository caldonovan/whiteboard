<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Request as Req;

class PostView extends Model
{
    use HasFactory;

    // * Logs the users information when viewing a post
    public static function createViewLog($post)
    {

        if (Auth::guest()) {
            $uid = null;
        } else {
            $uid = Auth::user()->id;
        }

        // dd("User ID: ".$uid. " | Post ID: ".$pid);
        $pid = $post->id;
        $isUnique = DB::table('post_views')->where([
            ['user_id', '=', $uid],
            ['post_id', '=', $pid],
        ])->doesntExist();

        if ($isUnique) {
            $pv = new PostView();
            $pv->post_id = $post->id;
            $pv->url = Req::url();
            $pv->session_id = Req::getSession()->getId();
            $pv->user_id = (Auth::user()) ? Auth::id() : null;
            $pv->ip = Req::getClientIp();
            $pv->agent = Req::header('User-Agent');
            $pv->save();
        }
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
