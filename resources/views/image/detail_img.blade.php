@extends('welcome')

@section('card-images')
    @if(count($user->images) == 0)
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                @include('includes.avatar', ['style' => 'float: left; width: 10%;', 'other_username' => $user->username])
            </div>

            <div class="card-body">
                card-body
            </div>
        </div>
    @else
        <div class="card" style="margin-top: 8%;">
            <div class="card-header" style="padding-top: 1%; padding-bottom: 1%;">
                @include('includes.avatar', ['style' => 'float:left; width: 10%;', 'other_username' => $user->username])
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
                            <i class="far fa-heart fa-2x"></i>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <i class="far fa-comment fa-2x"></i>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <i class="far fa-share-square fa-2x"></i>
                        </span>
                    </div>
                    <div class="col-md-1 offset-md-8">
                        <span>
                            <i class="far fa-bookmark fa-2x"></i>
                        </span>
                    </div>
                </div>
                @foreach($image->comments as $comment)
                    <div class="row" style="margin-top: 2%;">
                        <p>{{$comment['comment']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
