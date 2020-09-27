@extends('welcome')

@section('card-images')
    <p>aquí una foto/usuario</p>
    @foreach($user_list as $user)
        <div class="card" style="margin-top: 8%;">

            @include('layout_card_photo.header', ['user' => $user])

            <div class="card-body" style="margin-bottom:14%;">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(count($user->images) > 0)
                    <a href="{{ url('/image/detail/'.$user->lastImgUpload()['image_path']) }}">
                        <img src="{{ url('/image/'.$user->lastImgUpload()['image_path']) }}" class="detail-img" />
                    </a>
                @else
                    <img src="{{ url('image/no_image_available.png') }}" class="detail-img" />
                @endif

                @if($user->lastImgUpload() != null)
                    @include('includes.like-comment-share', ['image' => $user->lastImgUpload()])
                @endif
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var params = {
                'fromUserId': {{ Auth::user()->id }},
                'toUserId': {{ $user->id }},
                'image_id': {{ $user->lastImgUpload()->id }}
            };

            $('#like-img,#dislike-img').on('click', function() {
                if ($(this).prop('id').split('-')[0] == 'like') {
                    var route = "{{ route('like.img') }}";
                    axios_post(route, params, like_img);
                } else {
                    var route = "{{ route('dislike.img') }}";
                    axios_post(route, params, dislike_img);
                }
            });

        });
    </script>
@endsection

