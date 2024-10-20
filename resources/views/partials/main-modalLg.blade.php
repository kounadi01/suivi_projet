<div id="@if(isset($id)){{$id}}@else{{trim('main-modal')}}@endif" class="main-modal modal fade" role="dialog" tabindex="-1">
    <div
        aria-hidden="true"
        aria-labelledby="@if(isset($id)){{$id}}@else{{trim('main-modal')}}@endif"
        class="modal-dialog modal-lg modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content"></div>
    </div>
</div>