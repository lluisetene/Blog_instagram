@if(Auth::user()->image_path)
    <img src="{{ url('/user/avatar/'.$user->image_path) }}" class="avatar" style="{{ $style ?? '' }}"/>
    <span style="margin-left: 2%">
        {{ $other_username ?? '' }}
    </span>
@else
    <img src="{{ asset('users/profile_default.png') }}" class="avatar" style="{{ $style ?? '' }}"/>
@endif
