@extends('welcome')

@section('card-images')
    <p>aquí una foto/usuario</p>
    @foreach($user_list as $user)
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                @include('includes.avatar', ['style' => 'width:10%;', 'other_username' => $user->username] )
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ url('/image/detail/'.$user->lastImgUpload()['image_path']) }}">
                    <img src="{{ url('/image/'.$user->lastImgUpload()['image_path']) }}" class="detail-img" />
                </a>
            </div>

        </div>
    @endforeach
@endsection
