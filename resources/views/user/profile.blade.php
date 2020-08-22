@extends('user.show')

@section('card-images')
    @if(count($user->images) == 0)
        <div class="card" style="margin-top: 8%;">
            @if($user->id == Auth::user()->id)
                <div class="card-header">
                    <p>{{ __('Upload your first photo! :)') }}</p>
                </div>

                <div class="card-body">
                    @include('image.uploadImg')
                </div>
            @else
                <div class="card-body" style="text-align:center;">
                    <p>{{ __('User without photos! :(') }}</p>
                </div>
            @endif
        </div>
    @else
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                <div class="col-md" style="text-align: center;">
                    @if(Auth::user()->id == $user->id)
                        <a href="{{ route('image.index') }}">
                            <span><i class="fas fa-plus-circle fa-2x" style="color:black;"></i></span>
                        </a>
                    @endif
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
                            <a href="{{ route('image.show', ['filename' => $image->image_path]) }}">
                                <img src="{{ url('/uploads/'.$image->image_path) }}" class="upload-img" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
