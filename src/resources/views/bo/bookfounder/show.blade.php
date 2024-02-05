@extends('layouts.appbo')

@section('content_title', 'Booking Founder Info')

@section('toolbar')

<!-- button back -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfounder.index') }}">
        <i class="fas fa-lg fa-arrow-left"></i>
    </a>
</li>

@if ($viewModel->data->orderstatus_id == 1)

<!-- button close -->
<!-- <li class="nav-item">

    <a  onclick="event.preventDefault();"
        data-toggle="modal" data-target="#modal-approve"
        class="nav-link" href="#"
    ><span style="font-weight: bold;">Approve</span></a>

</li> -->

<!-- button cancel -->
<li class="nav-item">

    <a  onclick="event.preventDefault();"
        data-toggle="modal" data-target="#modal-cancel"
        class="nav-link" href="#"
    ><span style="font-weight: bold;">Cancel</span></a>

</li>

<!-- button edit -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfounder.edit', ['bookfounder' => $viewModel->data->id]) }}">
        <i class="fas fa-lg fa-edit"></i>
    </a>
</li>
@endif

<!-- button delete -->
<li class="nav-item">

    <a  onclick="event.preventDefault();"
        data-toggle="modal" data-target="#modal-delete"
        class="nav-link" href="#"
    >
        <i class="fas fa-lg fa-trash"></i>
    </a>

    <form id="frmData" role="form" id="frmData" method="POST" action="{{ route('bookfounder.destroy', ['bookfounder' => $viewModel->data->id]) }}">
        @csrf
        @method('DELETE')
    </form>
</li>


@endsection

@section('content')
    @include('bo.bookroom.data-field-items')
@endsection

@section('style')

    <!-- Styles -->
    <!-- <link href="{{ asset('css/CustomForShow.css') }}" rel="stylesheet"> -->

@endsection

@section('js')

    <!-- javascript -->
    <!-- <script src="{{ asset('js/CustomForShow.js') }}" defer></script> -->

    <script>
        
        var modalClose = $("#modalClose");
        var modalCloseResolution = $("#modalCloseResolution");

        function deleteOrder() {

            modalClose.click();
            event.preventDefault();
            document.getElementById('frmData').submit();

        } //end method

        function approveOrder() {

            modalCloseResolution.click();
            event.preventDefault();
            document.getElementById('frmDataApprove').submit();

        } //end method

        function rejectOrder() {

            modalCloseResolution.click();
            event.preventDefault();
            document.getElementById('frmDataReject').submit();

        } //end method

        function cancelOrder() {

            modalCloseResolution.click();
            event.preventDefault();
            document.getElementById('frmDataCancel').submit();

        } //end method

    </script>

@endsection

@php($baseRoute='bookfounder')
@include('bo.bookroom.modal-approve')    
@include('bo.bookroom.modal-cancel')    
@include('bo.bookroom.modal-delete')    
