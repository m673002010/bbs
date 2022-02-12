
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include("layout.error")
    <form action="/posts/{{$post->id}}" method="POST">
        {{method_field("PUT")}}
        {{csrf_field()}}
        <div>标题:<input name="title" type="text" value="{{$post->title}}"></input></div> 
        <div>内容:<textarea name="content">{{$post->content}}</textarea></div>
        <div><button type="submit">提交</button></div>
    </form>
</body>
</html>
