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
            <i id="saved-img" class="far fa-bookmark fa-2x" style="cursor:pointer;"></i>
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

<script type="application/javascript">
    var params = {
        'fromUserId': {{ Auth::user()->id }},
        'toUserId': {{ $user->id }},
        'image_id': {{ $image->id }}
    };

    $('#comment-to-send').on('keyup', function() {
        if (!$(this).val()) {
            $('#send-comment-btn').prop('disabled', true);
        } else {
            $('#send-comment-btn').prop('disabled', false);
        }
    });

    $('#like-img,#dislike-img').on('click', function() {
        if ($(this).prop('id').split('-')[0] == 'like') {
            var route = "{{ route('like.img') }}";
            axios_post(route, params, like_img);
        } else {
            var route = "{{ route('dislike.img') }}";
            axios_post(route, params, dislike_img);
        }
    });

    $("div[name='like-comment'],div[name='dislike-comment']").on('click', function() {
        var comment_id = $(this).attr('value');
        params['comment_id'] = comment_id;
        if ($(this).attr('name') == 'like-comment') {
            var route = "{{ route('like.comment') }}";
            axios_post(route, params, like_comment(comment_id));
        } else {
            var route = "{{ route('dislike.comment') }}";
            axios_post(route, params, dislike_comment(comment_id));
        }
    });

    $('#saved-img').on('click', function() {
        var route = "{{ route('saved.store') }}";
        axios_post(route, params, function() {
            $(this).removeClass('far fa-bookmark fa-2x').addClass('fas fa-bookmark fa-2x');
        });
    });
</script>

