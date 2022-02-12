
<!DOCTYPE html>
<html lang="zh-CN">
<head></head>
<body>
    <title>show blog</title>
    <div>id: <a href="/posts/{{$post->id}}"></a>{{$post->id}}</div>
    <div>title: {{$post->title}}</div>
    <div>content: {{$post->content}}</div>
    <div>created_at: {{$post->created_at->toFormattedDateString()}}</div>
    <br>
    
    <a href="http://www.laravel54.com/posts/{{$post->id}}/edit">编辑文章</a>
    <a href="http://www.laravel54.com/posts/{{$post->id}}/delete">删除文章</a>
    
    <ul>
        @foreach($post->comments as $comment)
            <li>作者:{{$comment->user->username}}</li>
            <li>评论内容:{{$comment->content}}</li>
            <li>时间:{{$comment->created_at}}</li>
            <br>
        @endforeach
    </ul>

    @if($post->zan(\Auth::id())->exists())
        <a href="http://www.laravel54.com/posts/{{$post->id}}/unzan" type="button">取消赞</a>
    @else
        <a href="http://www.laravel54.com/posts/{{$post->id}}/zan" type="button">点赞</a>
    @endif

    <form action="/posts/{{$post->id}}/comment" method="POST">
        {{csrf_field()}}
        <div>评论:<textarea name="content"></textarea></div>
        <div><button type="submit">提交评论</button></div>
    </form>
    @include("layout.error")
</body>
</html>
