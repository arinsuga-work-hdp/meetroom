@extends('layouts.appbo')

@section('content_title', 'Booking Postmo Info')

@section('toolbar')

<!-- button back -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookpostmo.index') }}">
        <i class="fas fa-lg fa-arrow-left"></i>
    </a>
</li>

<!-- <li class="nav-item">
    <a class="nav-link" href="{{ route('support.close', ['support' => $viewModel->data->id]) }}">
        <span style="font-weight: bold;">status = {{ $viewModel->data->activitystatus_id }}</span>
    </a>
</li> -->

@if ($viewModel->data->orderstatus_id == 3)
    <!-- button Reopen -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('bookpostmo.reopen', ['bookpostmo' => $viewModel->data->id]) }}">
            <span style="font-weight: bold;">Reopen</span>
        </a>
    </li> -->
@endif

@if ($viewModel->data->orderstatus_id == 1)
<!-- button cancel -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookpostmo.cancel', ['bookpostmo' => $viewModel->data->id]) }}">
        <span style="font-weight: bold;">Cancel</span>
    </a>
</li>

<!-- button edit -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookpostmo.edit', ['bookpostmo' => $viewModel->data->id]) }}">
        <i class="fas fa-lg fa-edit"></i>
    </a>
</li>
@endif

<!-- button delete -->
<li class="nav-item">

    <!-- <a onclick="event.preventDefault(); document.getElementById('frmData').submit();"
       class="nav-link" href="#">
        <i class="fas fa-lg fa-trash"></i>
    </a> -->

    <a  onclick="event.preventDefault();"
        data-toggle="modal" data-target="#modal-delete"
        class="nav-link" href="#"
    >
        <i class="fas fa-lg fa-trash"></i>
    </a>

    <form id="frmData" role="form" id="frmData" method="POST" action="{{ route('bookpostmo.destroy', ['bookpostmo' => $viewModel->data->id]) }}">
        @csrf
        @method('DELETE')
    </form>
</li>


@endsection

@section('content')
    @include('bo.bookpostmo.data-field-items')
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

    </script>

@endsection

@include('bo.bookpostmo.modal-delete')    
@include('bo.bookpostmo.modal-approve')    
