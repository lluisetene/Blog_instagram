@extends('welcome')

@section('card-images')
    @foreach($user_list as $user)
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                <a href="{{ route('user.show', ['id' => $user->id]) }}" style="color:black;">
                    @include('includes.avatar', ['style' => 'width:10%', 'user' => $user, 'other_username' => $user->username])
                </a>
            </div>

            <div class="card-body">
                aquí una foto
            </div>
        </div>
    @endforeach
@endsection
