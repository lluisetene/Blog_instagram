@extends('user.show', ['user' => Auth::user()])

@section('card-images')
    <div class="card" style="margin-top: 5%;">
        <div class="card-body">
            <form method="POST" action="{{ route('image.upload', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                    <div class="col-md-6">
                        <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" value="{{ $image_path ?? '', old('image_path') }}" autofocus>
                        @error('image_path')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" autofocus required placeholder="{{__('Description...')}}"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Upload photos!') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
