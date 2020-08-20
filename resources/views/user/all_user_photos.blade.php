@extends('welcome')

@section('card-images')
    <p>aquí una foto/usuario</p>
    @foreach($user_list as $user)
        <div class="card" style="margin-top: 8%;">
            <div class="card-header">
                {{ __('Dashboard') }}
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{ $user->firstname }} {{ $user->lastname }}
            </div>

        </div>
    @endforeach
@endsection
