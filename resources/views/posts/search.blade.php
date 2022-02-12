
<!DOCTYPE html>
<html lang="zh-CN">
<head></head>
<body>
    <title>search</title>
    <div>
        下面是搜索{{$query}}的结果，共{{$posts->total()}}条
    </div>

    <div> 
        @foreach($posts as $post)
            <a href="http://www.laravel54.com/posts/{{$post->id}}"><div>id: {{$post->id}}</div></a>
            <div>标题: {{$post->title}}</div>
            <div>内容: {{$post->content}}</div>
            <div>创建时间: {{$post->created_at->toFormattedDateString()}}</div>
            <br>
        @endforeach
    </div>

    {{$posts->links()}}
</body>
</html>
