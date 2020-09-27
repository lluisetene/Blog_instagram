<div class="row" style="margin-top: 1%;">
    <div class="col-md-1">
        <span>
            @if(count($image->likes) > 0)
                <i id="dislike-img" class="fas fa-heart fa-2x" style="cursor:pointer; color:red;"></i>
            @else
                <i id="like-img" class="far fa-heart fa-2x" style="cursor:pointer;"></i>
            @endif
        </span>
    </div>
    <div class="col-md-1">
        <span>
            <i id="comment-img" class="far fa-comment fa-2x" style="cursor:pointer;"></i>
        </span>
    </div>
    <div class="col-md-1">
        <span>
            <i id="share-img" class="far fa-share-square fa-2x" style="cursor:pointer;"></i>
        </span>
    </div>
    <div class="col-md-1 offset-md-8">
        <span>
            <i class="far fa-bookmark fa-2x" style="cursor:pointer;"></i>
        </span>
    </div>
</div>
<div id="nrLikes" class="row col-md-6">
    {{ count($image->likes) }} Me gusta
</div>

<div style="margin-top:2%;">
    <a href="{{ route('user.show', ['id' => $image->user->id]) }}" style="color:black;">
        <span style="font-weight:bold;">{{$image->user->username}}</span>
    </a>
    {{$image->description}}
</div>

