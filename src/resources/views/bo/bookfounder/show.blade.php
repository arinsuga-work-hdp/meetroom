@extends('layouts.appbo')

@section('content_title', 'Booking Founder Info')

@section('toolbar')

<!-- button back -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfounder.index') }}">
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
        <a class="nav-link" href="{{ route('bookfounder.reopen', ['bookfounder' => $viewModel->data->id]) }}">
            <span style="font-weight: bold;">Reopen</span>
        </a>
    </li> -->
@endif

@if ($viewModel->data->orderstatus_id == 1)
<!-- button close -->
<li class="nav-item">

    <a  onclick="event.preventDefault();"
        data-toggle="modal" data-target="#modal-approve"
        class="nav-link" href="#"
    ><span style="font-weight: bold;">Approve</span></a>

</li>
<!-- button pending -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfounder.reject', ['bookfounder' => $viewModel->data->id]) }}">
        <span style="font-weight: bold;">Reject</span>
    </a>
</li>
<!-- button cancel -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfounder.cancel', ['bookfounder' => $viewModel->data->id]) }}">
        <span style="font-weight: bold;">Cancel</span>
    </a>
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

    <form id="frmData" role="form" id="frmData" method="POST" action="{{ route('bookfounder.destroy', ['bookfounder' => $viewModel->data->id]) }}">
        @csrf
        @method('DELETE')
    </form>
</li>


@endsection

@section('content')
    @include('bo.bookfounder.data-field-items')
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

@include('bo.bookfounder.modal-delete')    
@include('bo.bookfounder.modal-approve')    
