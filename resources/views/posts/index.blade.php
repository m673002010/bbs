
<!DOCTYPE html>
<html lang="zh-CN">
<head></head>
<body>
    <form action="/posts/search" method="GET">
        <input type="text" name="query" value="">
        <div><button type="submit">搜索</button></div>
    </form>
    
    @include("layout.sidebar")
    
    <br>
    @if(\Auth::id())
        <a href="http://www.laravel54.com/logout">登出</a>
        <a href="http://www.laravel54.com/user/{{\Auth::id()}}">我的主页</a>
    @endif

    <title>laravel for blog</title>
    @foreach($postsList as $post)
        <a href="http://www.laravel54.com/posts/{{$post->id}}"><div>id: {{$post->id}}</div></a>
        <div>作者: <a href="http://www.laravel54.com/user/{{$post->user->id}}">{{$post->user->username}}</a></div>
        <div>标题: {{$post->title}}</div>
        <div>内容: {{$post->content}}</div>
        <div>评论数: {{$post->comments_count}}</div>
        <div>点赞数: {{$post->zans_count}}</div>
        <div>创建时间: {{$post->created_at->toFormattedDateString()}}</div>
        <br>
    @endforeach

    {{$postsList->links()}}

    <a href="http://www.laravel54.com/posts/create">创建文章</a>
</body>
</html>
