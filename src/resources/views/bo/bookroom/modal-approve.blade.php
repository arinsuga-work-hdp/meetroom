<div class="modal fade" id="modal-approve">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Keterangan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        
        <form role="form" id="frmDataApprove" method="POST" action="{{ route($baseRoute.'.update.approve', [$baseRoute => $viewModel->data->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- textarea -->
            <div class="form-group">
                <label></label>
                <textarea id="resolution" name="resolution" class="form-control" rows="3" placeholder="">{{ ( $errors->any() ? old('resolution') : $viewModel->data->resolution ) }}</textarea>
                <p class="text-red">{{ $errors->first('resolution') }}</p>
            </div>

        </form>

    </div>
    <div class="modal-footer justify-content-between">
        <button id="modalCloseResolution" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button onclick="approveOrder();" type="button" class="btn btn-primary">Approve Order</button>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
