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

                @include('includes.like-comment-share', ['$image' => $image])

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
                axios_post("{{ route('comment.save') }}", params, send_comment);
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

        });
    </script>
@endsection
