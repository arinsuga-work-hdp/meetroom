@extends('layouts.appbo')

@section('content_title', 'Revisi Booking Postmo')

@section('toolbar')

<li class="nav-item">
    <a class="nav-link" href="{{ url()->previous() }}">
        <i class="fas fa-lg fa-arrow-left"></i>
    </a>
</li>

<li class="nav-item">
    <a onclick="event.preventDefault(); document.getElementById('frmData').submit();"
       class="nav-link" href="#">
        <i class="fas fa-lg fa-save"></i>
    </a>
</li>

@endsection

@section('content')

<form role="form" id="frmData" method="POST" action="{{ route('bookpostmo.update', ['bookpostmo' => $viewModel->data->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('bo.bookroom.error-message')

    @include('bo.bookroom.data-field-items')
</form>

@endsection

@section('js')

    @include('bo.bookroom._script')

@endsection
