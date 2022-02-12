<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Zan;

class PostController extends Controller
{
    public function index() {
        $postModel = new Post();
        $postsList = $postModel->orderBy("created_at", "desc")->withCount(["comments", "zans"])->paginate(5);
        // $postsList = $postModel->orderBy("created_at", "desc")->get();
        return view("posts/index", compact("postsList"));
        // return compact("postsList");
    }

    public function show(Post $post) {
        $post->load("comments");
        return view("posts/show", compact("post"));
    }

    public function create() {
        return view("posts/create");
    }

    public function store() {
        $this->validate(request(), [
            "title" => "required|string|max:100|min:5",
            "content" => "required|string|max:100|min:5",
        ]);

        // $postModel = new Post();
        // $postModel->title = request("title");
        // $postModel->content = request("content");
        // $postModel->save();

        // $params = ["title"=> request("title"), "content"=> request("content")];
        // $res = Post::create($params);

        $user_id = \Auth::id();
        $params = array_merge(request(["title", "content"]), compact("user_id"));
        // dd($params);
        $res = Post::create($params);

        return redirect("/posts");
    }

    public function edit(Post $post) {
        return view("posts/edit", compact("post"));
    }

    public function update(Post $post) {
        $this->validate(request(), [
            "title" => "required|string|max:100|min:5",
            "content" => "required|string|max:100|min:5",
        ]);

        $post->title = request("title");
        $post->content = request("content");
        $post->save();

        return redirect("/posts/{$post->id}");
    }

    public function delete(Post $post) {
        $post->delete();

        return redirect("/posts");
    }

    public function comment(Post $post) {
        $this->validate(request(), [
            "content" => "required|string|min:5",
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request("content");
        
        $post->comments()->save($comment);

        return back();
    }

    public function zan(Post $post) {
        $params = [
            "user_id" => \Auth::id(),
            "post_id" => $post->id,
        ];

        Zan::firstOrCreate($params);

        return back();
    }

    public function unzan(Post $post) {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    public function search() {
        $this->validate(request(), [
            "query" => "required",
        ]);

        $query = request("query");
        $posts = \App\Post::search($query)->paginate(2);

        return view("posts/search", compact("posts", "query"));
    }
}
