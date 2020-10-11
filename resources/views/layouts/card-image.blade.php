@section('card-image')
    <div class="card" style="margin-top:8%;">
        <div class="card-header">
            @include('layout_card_photo.header', ['user' => $user])
        </div>

        <div class="card-body">
            @include('layout_card_photo.body')
        </div>

        <script>
            @section('script-card-image')
        </script>
    </div>
@endsection