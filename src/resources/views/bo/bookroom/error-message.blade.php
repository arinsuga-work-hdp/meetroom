@if ($errors->first('custom') !== '')

<div class="alert alert-danger alert-dismissible" style="width: 50%;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <p>{{$errors->first('custom')}}</p>
</div>

@endif


@if ($errors->first('startend') !== '')

<div class="alert alert-danger alert-dismissible" style="width: 50%;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <p>{{$errors->first('startend')}}</p>
</div>

@endif
