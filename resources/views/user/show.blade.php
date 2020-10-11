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

                                @include('includes.avatar', ['style' => 'float:left; width:100%;', 'user' => $user])

                                <p>Blog personal</p>
                            </div>
                            <div class="row col-md-9" style="margin-top: 5%;">
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="publications_count">{{ count($user->images) }} {{ __('Publications') }}</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="followers_count">{{ count($user->followers) }} {{ __('Followers') }}</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="followeds_count">{{ count($user->followeds) }} {{ __('Followeds') }}</p>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->id != $user->id)
                            <div class="row">
                                @if($user->followers->firstWhere('user_id', Auth::user()->id))
                                    <input type="button" id="unfollow_btn" style="margin-left:2%;" value="{{__('Unfollow')}}" class="btn btn-primary btn-md">
                                @else
                                    <input type="button" id="follow_btn" style="margin-left:2%;" value="{{__('Follow')}}" class="btn btn-primary btn-md">
                                @endif
                            </div>
                            <!-- id="unfollow_btn" -->
                        @endif
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function dict(elem) {
                let btnId = elem.prop('id');
                let params =  {
                    'fromUserId': "{{ Auth::user()->id }}",
                    'toUserId': "{{ $user->id }}",
                };
                if (btnId == 'unfollow_btn') {
                    var route = "{{ route('follow.unfollow') }}";
                } else {
                    var route = "{{ route('follow.follow') }}";
                }

                return [route, params, btnId];
            };

            $('#unfollow_btn, #follow_btn').on('click', function() {
                var values = dict($(this));
                axios_post(values[0], values[1], function() {
                    if (values[2] == 'unfollow_btn') {
                        $('#unfollow_btn').val("{{ __('Follow') }}").prop('id', 'follow_btn');
                        let followers = $('#followers_count').text().split(' ');
                        let followersNr = parseInt(followers[0]) - 1;
                        $('#followers_count').text(followersNr + ' ' + followers[1]);
                    } else {
                        $('#follow_btn').val("{{ __('Unfollow') }}").prop('id', 'unfollow_btn');
                        let followers = $('#followers_count').text().split(' ');
                        let followersNr = parseInt(followers[0]) + 1;
                        $('#followers_count').text(followersNr + ' ' + followers[1]);
                    }
                });
            });
        });
    </script>
@endsection


