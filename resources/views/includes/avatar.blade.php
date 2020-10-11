@if($user->image_path)
    <img src="{{ url('/user/avatar/'.$user->image_path) }}" class="avatar" style="{{ $style ?? '' }}"/>
@else
    <img src="{{ asset('img/users/profile_default.png') }}" class="avatar" style="{{ $style ?? '' }}"/>
@endif
<span style="margin-left:2%; vertical-align:sub;">
    <a href="{{ route('user.show', ['id' => $user->id]) }}" style="color:black;">
        {{ $other_username ?? $user->username }}
    </a>
</span>
