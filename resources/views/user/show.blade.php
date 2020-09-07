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
                                <p>{{ $user->username }}</p>
                                <p>Blog personal</p>
                            </div>
                            <div class="row col-md-9" style="margin-top: 5%;">
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="publications_count">{{ count($user->images) }} publicaciones</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="followers_count">{{ count($user->followers) }} seguidores</p>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <p id="followeds_count">{{ count($user->followeds) }} seguidos</p>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->id != $user->id)
                            <div class="row">
                                @if($user->followers->firstWhere('user_id', Auth::user()->id))
                                    <input type="button" id="follow_unfollow_btn" name="unfollow" value="{{__('Unfollow')}}" class="btn btn-primary btn-md">
                                @else
                                    <input type="button" id="follow_unfollow_btn" name="follow" value="{{__('Follow')}}" class="btn btn-primary btn-md">
                                @endif
                                <div id="div_msg" class="" role="alert" style="margin-left:10%;">
                                    <span id="msg"></span>
                                </div>
                            </div>
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
            $('#follow_unfollow_btn').on('click',
                function follow_unfollow_ajax() {
                var name_btn = $(this).prop('name');
                var route = "{{ route('follow.index') }}";
                var params = {
                    'fromUserId': "{{ Auth::user()->id }}",
                    'toUserId': "{{ $user->id }}",
                    'funct': name_btn
                }
                axios.post(route, params)
                    .then(function (res) {
                        $('#div_msg').addClass('alert alert-success').text(res.data.msg);
                        $('#followers_count').text('' + res.data.followers + ' seguidores');
                        $('#followeds_count').text('' + res.data.followeds + ' seguidos');
                        if ($('#follow_unfollow_btn').prop('name') == 'follow') {
                            $('#follow_unfollow_btn').prop('name', 'unfollow').val("{{__('Unfollow')}}");
                        } else {
                            $('#follow_unfollow_btn').prop('name', 'follow').val("{{__('Follow')}}");
                        }
                    })
                    .catch(function (error) {
                        $('#div_msg').addClass('alert alert-danger').text(error);
                });
            });
        });
    </script>
@endsection


