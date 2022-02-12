
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include("layout.error")
    <form action="/posts" method="POST">
        {{csrf_field()}}
        <div>标题:<input name="title" type="text"></input></div> 
        <div>内容:<textarea name="content"></textarea></div>
        <div><button type="submit">提交</button></div>
    </form>
</body>
</html>
