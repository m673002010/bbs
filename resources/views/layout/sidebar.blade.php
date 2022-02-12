<!DOCTYPE html>
<html lang="zh-CN">
<head></head>
<body>
    <div style="float: right "> 
        主题列表:
        @foreach($topics->all() as $topic)
            <li><a href="http://www.laravel54.com/topics/{{$topic->id}}">{{$topic->name}}</li>
        @endforeach
    </div>
</body>
</html>
