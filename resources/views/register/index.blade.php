<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <form action="/register" method="POST">
        {{csrf_field()}}
        <div>帐号:<input name="username" type="text" value=""></input></div> 
        <div>邮箱:<input name="email" type="text" value=""></input></div> 
        <div>密码:<input name="password" type="text" value=""></input></div> 
        <div><button type="submit">注册</button></div>
        @include("layout.error")
    </form>
</body>
</html>
