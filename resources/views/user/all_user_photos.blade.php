@extends('welcome')
@extends('layouts.card-image')

@section('card-images')

    @foreach($user_list as $user)
        @if ($user->id != Auth::user()->id and !$user->private_account or ($user->private_account and $user->followers->firstWhere('user_id', Auth::user()->id)))
            <div class="card" style="margin-top: 8%;">

                @include('layout_card_photo.header', ['user' => $user])

                <div class="card-body" style="margin-bottom:14%;">

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
        @endif
    @endforeach
@endsection


