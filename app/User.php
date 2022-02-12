<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // protected $guard; // 不可以注入的字段
    protected $fillable = ["username", "email", "password"]; // 可以注入的字段

    // 获取用户文章
    public function posts() {
        return $this->hasMany(\App\Post::class, "user_id", "id");
    }

    // 获取用户的粉丝
    public function fans() {
        return $this->hasMany(\App\Fan::class, "star_id", "id");
    }

    // 获取用户关注的人
    public function stars() {
        return $this->hasMany(\App\Fan::class, "fan_id", "id");
    }

    // 用户关注其他人
    public function doFan($uid) {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    // 用户取消关注其他人
    public function doUnFan($uid) {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    // 判断当前用户是否被关注
    public function hasFan($uid) {
        return $this->fans()->where("fan_id", $uid)->count();
    }
    
    // 判断当前用户是否关注了其他人
    public function hasStar($uid) {
        return $this->stars()->where("star_id", $uid)->count();
    }
}
