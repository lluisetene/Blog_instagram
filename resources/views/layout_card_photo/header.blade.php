@section('modal-body')
    <?php
        $btnList = [
            'Report' => 'color:#FF0000;',
            'Unfollow' => 'color:#FF0000;',
            'Publication' => '',
            'Share' => '',
            'Link copy' => '',
            'Código de inserción' => '',
            'Cancel' => ''
        ]
    ?>

    @foreach($btnList as $key => $val)
        @php($showUnfollowBtn = true)
        @if($key == 'Unfollow')
            @if(count(Auth::user()->followeds) == 0)
                @php($showUnfollowBtn = false)
            @else
                @foreach(Auth::user()->followeds as $userFollowed)
                    @if ($user->id == $userFollowed->toUser_id)
                        @php($showUnfollowBtn = false)
                        @break
                    @endif
                @endforeach
            @endif
        @endif

        @if($key == 'Unfollow' and $showUnfollowBtn == false)
            @continue
        @else
            <div class="row">
                @if ($val == '')
                    @php($val = 'color:black;')
                @endif
                <input name="{{ $key }}" class="btn btn-light" type="button" style="width:100%; {{ $val }}" value="{{ __($key) }}" />
            </div>
        @endif
    @endforeach
@endsection


@section('modal-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name=Unfollow]').on('click', function () {
                let params =  {
                    'fromUserId': "{{ Auth::user()->id }}",
                    'toUserId': "{{ $user->id }}",
                };
                var route = "{{ route('follow.unfollow') }}";
                axios_post(route, params, function() {
                   location.reload();
                });
            });
            $('input[name=Cancel]').on('click', function() {
                $('#modalSettings').modal('hide');
            });
        });
    </script>
@endsection


<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            @include('includes.avatar', ['style' => 'width:25%;', 'other_username' => $user->username] )
        </div>

        <div class="col-md-1 offset-md-7">

            @include('layouts.modal')

            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalSettings" style="color:black;">
                <i class="fas fa-ellipsis-h"></i>
            </button>

        </div>

    </div>
</div>