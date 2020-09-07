<div class="row">
    <div class="col-sm-11" style="margin-top: 2%;">
        <div>
            <a href="{{ route('user.show', ['id' => $user->id]) }}" style="color:black; font-weight:bold;">
                @include('includes.avatar', ['style' => 'float:left; width:8%;', 'user' => $user, 'other_username' => $user->username])
            </a>
            <span name="comment" style="vertical-align:sub;">{{ $comment['comment'] }}</span>
        </div>
    </div>
    <div class="col-sm-1">
        @if(count($comment->likes->where('user_id', Auth::user()->id)) > 0)
            <div name="dislike-comment" value="{{ $comment->id }}">
                <i class="fas fa-heart fa-lg" style="cursor:pointer; color:red; margin-top:100%;"></i>
            </div>
        @else
            <div name="like-comment" value="{{ $comment->id }}">
                <i class="far fa-heart fa-lg" style="cursor:pointer; margin-top:100%;"></i>
            </div>
        @endif
    </div>
</div>
