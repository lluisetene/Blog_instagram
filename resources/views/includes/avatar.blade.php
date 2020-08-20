@if(Auth::user()->image_path)
    <div class="container-avatar" id="avatar">
        <img src="{{ url('/user/avatar/'.Auth::user()->image_path) }}" class="avatar" style="{{ $style ?? '' }}"/>
    </div>
@else
    <div class="container-avatar" id="avatar">
        <img src="{{ asset('users/profile_default.png') }}" class="avatar" style="{{ $style ?? '' }}"/>
    </div>
@endif
