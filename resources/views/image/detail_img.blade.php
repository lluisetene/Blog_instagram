@extends('welcome')

@section('card-images')
    @if(count($user->images) == 0)
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                @include('includes.avatar', ['style' => 'float: left; width: 10%;', 'user' => $user, 'other_username' => $user->username])
            </div>

            <div class="card-body">
                card-body
            </div>
        </div>
    @else
        <div class="card" style="margin-top: 8%;">
            <div class="card-header" style="padding-top: 1%; padding-bottom: 1%;">
                @include('includes.avatar', ['style' => 'float:left; width: 10%;', 'user' => $user, 'other_username' => $user->username])
            </div>

            <div class="card-body" style="margin-top: -3%;">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <img src="{{ url('/image/'.$image->image_path) }}" class="detail-img" />
                </div>
                <div class="row" style="margin-top: 1%;">
                    <div class="col-md-1">
                        <span>
                            @if(count($image->likes->where('user_id', Auth::user()->id)) > 0)
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
                <div style="margin-top:2%;">
                    <a href="{{ route('user.show', ['id' => $user->id]) }}" style="color:black;">
                        <span style="font-weight:bold;">{{$user->username}}</span>
                    </a>
                    {{$image->description}}
                </div>
                @foreach($image->comments as $comment)
                    @include('comment.show_comments', ['comment' => $comment, 'user' => $user])
                @endforeach
                <div class="input-group mb-3" style="margin-top:3%;">
                    <input id="comment-to-send" type="text" class="form-control" placeholder="{{__('My comment...')}}" aria-label="User comment" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="send-comment-btn" disabled>Share</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <example-component></example-component>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var params = {
                'fromUserId': {{ Auth::user()->id }},
                'toUserId': {{ $user->id }},
                'image_id': {{ $image->id }}
            };

            $('#send-comment-btn').on('click', function() {
                params['comment-user'] = $('#comment-to-send').val();
                axios_post("{{ route('comment.save') }}", params);
            });

            $('#comment-to-send').on('keyup', function() {
               if (!$(this).val()) {
                   $('#send-comment-btn').prop('disabled', true);
               } else {
                   $('#send-comment-btn').prop('disabled', false);
               }
            });

            $('#like-img,#dislike-img').on('click', function() {
                if ($(this).prop('id').split('-')[0] == 'like') {
                    console.log('click like');
                    var route = "{{ route('like.img') }}";
                } else {
                    console.log('click dislike');
                    var route = "{{ route('dislike.img') }}";
                }
                ajax_call(route, {'funct': $(this).prop('id')});
            });

            $("div[name='like-comment'],div[name='dislike-comment']").on('click', function() {
                if ($(this).attr('name') == 'like-comment') {
                    console.log('click like comment');
                    var route = "{{ route('like.comment') }}";
                } else {
                    console.log('click dislike comment');
                    var route = "{{ route('dislike.comment') }}";
                }
                ajax_call(route, {'funct': $(this).attr('name'),
                                  'comment_id': $(this).attr('value')
                });
            })


            function ajax_call(route, params) {
                params['fromUserId'] = {{ Auth::user()->id }};
                params['toUserId'] = {{ $user->id }};
                params['image_id'] = {{ $image->id }};
                var funct = params['funct'];
                axios.post(route, params)
                    .then(function(res) {
                        if (funct == 'like-img') {
                            console.log('like');
                            $('#' + funct).removeClass('far fa-heart fa-2x').addClass('fas fa-heart fa-2x').css('color', 'red').attr('id', 'dislike-img');
                        } else if (funct == 'dislike-img') {
                            console.log('dislike');
                            $('#' + funct).removeClass('fas fa-heart fa-2x').addClass('far fa-heart fa-2x').css('color', '').attr('id', 'like-img');
                        } else if (funct == 'send-comment-btn') {
                            $("textarea[name='comment']").parent().append($("<input name='comment' value='res.data.comment-user' style='border:0px;'>"));
                            $('#' + funct).val('');
                        } else if (funct == 'like-comment') {
                            $('div[value="' + params['comment_id'] + '"]').children().removeClass('far fa-heart fa-lg').addClass('fas fa-heart fa-lg').css('color', 'red');
                            $('div[value="' + params['comment_id'] + '"]').attr('name', 'dislike-comment');
                        } else if (funct == 'dislike-comment') {
                            $('div[name="' + funct + '"]').children().removeClass('fas fa-heart fa-lg').addClass('far fa-heart fa-lg').css('color', '');
                            $('div[value="' + params['comment_id'] + '"]').attr('name', 'like-comment');
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
            }

        });
    </script>
@endsection
