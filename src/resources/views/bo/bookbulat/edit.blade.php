@extends('layouts.appbo')

@section('content_title', 'Revisi Booking Ruang Bulat')

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

<form role="form" id="frmData" method="POST" action="{{ route('bookbulat.update', ['bookbulat' => $viewModel->data->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('bo.bookbulat.data-field-items')
</form>

@endsection

@section('js')

    @include('bo.bookbulat._script')

@endsection