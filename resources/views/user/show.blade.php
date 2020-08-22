@extends('layouts.app')
@push('head')
    <script src="{{ asset('js/myjs.js') }}" defer></script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                @include('includes.avatar', ['style' => 'float:left; width:100%;'])
                                <div>
                                    <p>{{ $user->username }}</p>
                                    <p>Blog personal</p>
                                </div>
                            </div>
                            <div class="row col-md-9" style="margin-top: 5%;">
                                <div class="col-md-4" style="text-align: center;">
                                    <p>{{ count($user->images) }} publicaciones</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p>{{ count($user->followers) }} seguidores</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p>x seguidos</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @yield('card-images')

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        {{ __('You are logged in 21111122!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

</script>
