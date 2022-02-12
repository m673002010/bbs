@if($target_user->id != \Auth::id())
    <div>
        @if(\Auth::user()->hasStar($target_user->id))
            <button class="like-button" like-value="1" like-user="{{$target_user->id}}">取消关注</button>
        @else
            <button class="like-button" like-value="0" like-user="{{$target_user->id}}">关注</button>
        @endif
    </div>
@endif
