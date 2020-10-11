@extends('welcome')

@section('card-images')
    @if(count($user->images) == 0)
        <div class="card" style="margin-top: 8%;">

            @include('layout_card_photo.header')

            <div class="card-body">
                card-body
            </div>
        </div>
    @else
        <div class="card" style="margin-top: 8%;">

            @include('layout_card_photo.header', ['user' => $user])

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

        });
    </script>
@endsection
