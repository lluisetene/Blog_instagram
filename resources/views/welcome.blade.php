@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>aquí los histories</p>
                    </div>
                </div>

                @yield('card-images')

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        {{ __('You are logged in 2222!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
