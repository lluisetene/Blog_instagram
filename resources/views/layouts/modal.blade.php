<div class="modal fade" id="modalSettings" tabindex="-1" role="dialog" aria-labelledby="modalSettingsLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document" style="margin-top:10%;">
        <div class="modal-content">
            <div class="modal-header">
                @yield('modal-header')
{{--                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
            </div>
            <div class="modal-body">
                @yield('modal-body')
            </div>
            <div class="modal-footer">
                @yield('modal-footer')
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @yield('modal-script')
@endsection

