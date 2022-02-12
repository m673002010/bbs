<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function show(User $user) 
    {
        $user = User::withCount(["posts", "fans", "stars"])->find($user->id);

        // 获取用户的文章信息（最新10篇）
        $posts = $user->posts()->orderBy("created_at", "desc")->take(10)->get();

        // 获取用户关注的人的信息
        $stars = $user->stars();
        $susers = User::whereIn("id", $stars->pluck("star_id"))->withCount(["posts", "fans", "stars"])->get();

        // 获取粉丝信息
        $fans = $user->fans();
        $fusers = User::whereIn("id", $fans->pluck("fan_id"))->withCount(["posts", "fans", "stars"])->get();

        return view("user/show", compact("user", "posts", "susers", "fusers"));
    }

    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);

        return [
            "error" => "",
            "msg" => "",
        ];
    }

    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnFan($user->id);

        return [
            "error" => "",
            "msg" => "",
        ];
    }
}
