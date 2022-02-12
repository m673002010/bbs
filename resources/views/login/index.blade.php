
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <form action="/login" method="POST">
        {{csrf_field()}}
        <div>邮箱:<input name="email" type="text" value=""></input></div> 
        <div>密码:<input name="password" type="text" value=""></input></div>
        <div><input hidden name="is_remember" type="checkbox" value="1"></input></div> 
        <div><button type="submit">登录</button></div>
        @include("layout.error")
    </form>
</body>
</html>
