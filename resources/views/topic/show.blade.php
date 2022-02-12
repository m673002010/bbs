<!DOCTYPE html>
<html lang="zh-CN">
<head></head>
<body>
    <title>show topics</title>

    <p>主题:{{$topic->name}}</p><br>
    <p>文章数:{{$topic->post_topics_count}}</p><br>

    <div>
        已投稿:
        @foreach($posts as $post)
            <p><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></p>
            <p><a href="/posts/{{$post->id}}">{{$post->title}}</a></p>
        @endforeach
    </div>
    <br>

    <div>
        未投稿:
        <form action="/topics/{{$topic->id}}/submit" method="POST">
            {{csrf_field()}}
            @foreach($myPosts as $post)
                <input type="checkbox" name="post_ids[]" value="{{$post->id}}"> {{$post->title}}
            @endforeach
            <button type="submit">投稿</button>
        </form>
    </div>

</body>
</html>
