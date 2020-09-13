@if(Auth::user()->image_path)
    <img src="{{ url('/user/avatar/'.$user->image_path) }}" class="avatar" style="{{ $style ?? '' }}"/>
    <span style="margin-left:2%; vertical-align:sub;">
        <a href="{{ route('user.show', ['id' => $user->id]) }}" style="color:black;">
            {{ $other_username ?? '' }}
        </a>
    </span>
@else
    <img src="{{ asset('users/profile_default.png') }}" class="avatar" style="{{ $style ?? '' }}"/>
@endif
