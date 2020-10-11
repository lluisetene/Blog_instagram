@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md-1">

                @include('includes.histories')

                @yield('card-images')

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        @include('includes.recommended_users')

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
