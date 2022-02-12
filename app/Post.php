<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    protected $guard; // 不可以注入的字段
    protected $fillable = ["title", "content", "user_id"]; // 可以注入的字段

    use Searchable;

    /*
     * 搜索的type
     */
    public function searchableAs()
    {
        return 'posts';
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function comments()
    {
        return $this->hasMany("App\Comment")->orderBy("created_at", "desc");
    }

    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where("user_id", $user_id);
    }

    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where("user_id", $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class, "post_id", "id");
    }

    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave("postTopics", "and", function($q) use ($topic_id) {
            $q->where("topic_id", $topic_id);
        });
    }
}
