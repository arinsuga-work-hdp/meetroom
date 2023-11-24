<div class="modal fade" id="modal-cancel">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Keterangan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        
        <form role="form" id="frmDataCancel" method="POST" action="{{ route('bookpostmo.update.cancel', ['bookpostmo' => $viewModel->data->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- textarea -->
            <!-- <div class="form-group">
                <label></label>
                <textarea id="resolution" name="resolution" class="form-control" rows="3" placeholder="">{{ ( $errors->any() ? old('resolution') : $viewModel->data->resolution ) }}</textarea>
                <p class="text-red">{{ $errors->first('resolution') }}</p>
            </div> -->
            <p>Proses Cancel Order?</p>

        </form>

    </div>
    <div class="modal-footer justify-content-between">
        <button id="modalCloseCancelation" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button onclick="cancelOrder();" type="button" class="btn btn-primary">Cancel Order</button>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
