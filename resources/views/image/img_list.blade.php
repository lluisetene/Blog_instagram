@extends('user.show')

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
        @foreach($images as $image)
            <div class="card" style="margin-top: 8%;">
                <div class="card-header">
                    <div class="col-md" style="text-align: center;">
                        <a href="{{ route('image.index') }}">
                            <span><i class="fas fa-plus-circle fa-2x" style="color:black;"></i></span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <img src="{{ url('/uploads/'.$image->image_path) }}" class="upload-img" />
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
