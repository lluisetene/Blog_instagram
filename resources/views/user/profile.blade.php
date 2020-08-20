@extends('user.show')

@section('card-images')
    @if(count($user->images) == 0)
        <p>Usuario sin fotos</p>
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                @include('includes.avatar', ['style' => 'float: left; width: 10%;'])
            </div>

            <div class="card-body">
                card-body
            </div>
        </div>
    @else
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
                    @foreach($images as $image)
                        <div class="col-md-4 profile-img-uploads">
                            <img src="{{ url('/uploads/'.$image->image_path) }}" class="upload-img" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
