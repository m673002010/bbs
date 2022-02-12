<!DOCTYPE html>
<html lang="zh-CN">
<head>
</head>
<body>
    <div>个人中心页</div>
    <p>{{$user->username}}</p>
    <p>关注数:{{$user->stars_count}}</p>
    <p>粉丝数:{{$user->fans_count}}</p>
    <p>文章数:{{$user->posts_count}}</p>
    <br>

    @include("layout.like", ["target_user" => $user])

    <div>
        <p>文章列表</p>
        @foreach($posts as $post)
            <div>
                <p>作者:<a href="/user/{{$post->user_id}}">{{$post->user->username}}</a></p>
                <p>标题:<a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
                <p>内容:{!! str_limit($post->content, 100, '...') !!}</p>
                <p>时间:{{$post->created_at->diffForHumans()}}</p>
            </div>
            <br>
        @endforeach
    </div>
    <br>

    <div>
        <p>关注列表</p>
        @foreach($susers as $user)
            <div>
                <p class="">{{$user->username}}</p>
                <p class="">关注:{{$user->stars_count}} | 粉丝:{{$user->fans_count}}｜ 文章:{{$user->posts_count}}</p>
                @include("layout.like", ["target_user" => $user])
            </div>
        @endforeach
    </div>
    <br>

    <div>
        <p>粉丝列表</p>
        @foreach($fusers as $user)
            <div>
                <p class="">{{$user->username}}</p>
                <p class="">关注:{{$user->stars_count}} | 粉丝:{{$user->fans_count}}｜ 文章:{{$user->posts_count}}</p>
                @include("layout.like", ["target_user" => $user])
            </div>
        @endforeach
    </div>
</body>
<script>
    var Ajax = {
        // data应为'a=a1&b=b1'这种字符串格式，在jq里如果data为对象会自动将对象转成这种字符串格式
        get: function(url, data, callback){
            // XMLHttpRequest对象用于在后台与服务器交换数据
            var xhr = new XMLHttpRequest();
            xhr.open('GET',url,false);
            // 添加http头，发送信息至服务器时内容编码类型
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange=function(){
                // readyState == 4说明请求已完成
                if (xhr.readyState == 4){
                    if (xhr.status == 200 || xhr.status == 304){
                        console.log(xhr.responseText);
                        callback();
                    }
                }
            }
            xhr.send();
        }
    }

    var btn = document.getElementsByClassName("like-button");

    if (btn && btn[0]) {
        btn[0].onclick = function () {
            var likeValue = btn[0].getAttribute("like-value");
            var user_id = btn[0].getAttribute("like-user");

            // 关注/取消关注后的逻辑
            var fanFunc = function () {
                if (+likeValue) {
                    btn[0].setAttribute("like-value", 0);
                    btn[0].innerHTML = "关注";
                } else {
                    btn[0].setAttribute("like-value", 1);
                    btn[0].innerHTML = "取消关注";
                }
            }

            // 发送请求
            if (+likeValue) {
                Ajax.get("http://www.laravel54.com/user/" + user_id + "/unfan", null, fanFunc);
            } else { // 关注
                Ajax.get("http://www.laravel54.com/user/" + user_id + "/fan", null, fanFunc);
            }
        }
    }
</script>
</html>
