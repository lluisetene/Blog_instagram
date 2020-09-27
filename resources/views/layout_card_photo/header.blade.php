<div class="card-header">
    <div class="row">
        <div class="col-md-4">
            @include('includes.avatar', ['style' => 'width:25%;', 'other_username' => $user->username] )
        </div>

        <div class="col-md-1 offset-md-7">

                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">Action</button>
                        <button class="dropdown-item" type="button">Another action</button>
                        <button class="dropdown-item" type="button">Something else here</button>
                    </div>
                </div>



        </div>

    </div>
</div>