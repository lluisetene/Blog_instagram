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
                    <img src="{{ url('/uploads/'.$image->image_path) }}" class="detail-img" />
                </div>
                <div class="row" style="margin-top: 1%;">
                    <div class="col-md-1">
                        <span>
                            @if(count($image->likes->where('user_id', Auth::user()->id)) > 0)
                                <i id="dislike-photo" class="fas fa-heart fa-2x" style="cursor:pointer; color:red;"></i>
                            @else
                                <i id="like-photo" class="far fa-heart fa-2x" style="cursor:pointer;"></i>
                            @endif
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <i id="comment-photo" class="far fa-comment fa-2x" style="cursor:pointer;"></i>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <i id="share-photo" class="far fa-share-square fa-2x" style="cursor:pointer;"></i>
                        </span>
                    </div>
                    <div class="col-md-1 offset-md-8">
                        <span>
                            <i class="far fa-bookmark fa-2x" style="cursor:pointer;"></i>
                        </span>
                    </div>
                </div>
                @foreach($image->comments as $comment)
                    @include('comment.show_comments', ['comment' => $comment, 'user' => $user])
                @endforeach
                {{--@foreach($image->comments as $comment)
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
                @endforeach--}}
                <div class="input-group mb-3" style="margin-top:3%;">
                    <input id="comment-to-send" type="text" class="form-control" placeholder="{{__('My comment...')}}" aria-label="User comment" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="send-comment-btn" disabled>Share</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                /*axios_post("{{ route('comment.save') }}", params, function(res) {
                    console.log(res.data);
                    $("textarea[name='comment']").parent().append($("<input name='comment' value=res.data.comment-user style='border:0px;'>"));
                    $('#' + $(this).prop('id')).val('');
                });*/
            });

            $('#comment-to-send').on('keyup', function() {
               if (!$(this).val()) {
                   $('#send-comment-btn').prop('disabled', true);
               } else {
                   $('#send-comment-btn').prop('disabled', false);
               }
            });

            $('#like-photo,#dislike-photo').on('click', function() {
                ajax_call("{{ route('like.index') }}", {'funct': $(this).prop('id')});
            });

            $("div[name='like-comment'],div[name='dislike-comment']").on('click', function() {
                ajax_call("{{ route('like.index') }}", {'funct': $(this).attr('name'),
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
                        console.log(params);
                        console.log('entra en then');
                        if (funct == 'like-photo') {
                            $('#' + funct).removeClass('far fa-heart fa-2x').addClass('fas fa-heart fa-2x').css('color', 'red');
                        } else if (funct == 'dislike-photo') {
                            $('#' + funct).removeClass('fas fa-heart fa-2x').addClass('far fa-heart fa-2x').css('color', '');
                        } else if (funct == 'send-comment-btn') {
                            $("textarea[name='comment']").parent().append($("<input name='comment' value='res.data.comment-user' style='border:0px;'>"));
                            $('#' + funct).val('');
                        } else if (funct == 'like-comment') {
                            $('div[value="' + params['comment_id'] + '"]').children().removeClass('far fa-heart fa-lg').addClass('fas fa-heart fa-lg').css('color', 'red');
                        } else if (funct == 'dislike-comment') {
                            console.log('adasdasd');
                            $('div[name="' + funct + '"]').children().removeClass('fas fa-heart fa-lg').addClass('far fa-heart fa-lg').css('color', '');
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
            }

        });
    </script>
@endsection
