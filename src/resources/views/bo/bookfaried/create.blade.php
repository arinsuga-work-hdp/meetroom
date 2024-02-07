@extends('layouts.appbo')

@section('content_title', 'Booking Faried')

@section('toolbar')

<li class="nav-item">
    <a class="nav-link" href="{{ route('bookfaried.index') }}">
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

<form role="form" id="frmData" method="POST" action="{{ route('bookfaried.store') }}" enctype="multipart/form-data">
    @csrf

    @include('bo.bookroom.error-message')

    <div style="display: flex; justify-content=center;">
        @include('bo.bookroom.data-field-items')
    </div>
</form>

@endsection

@section('js')

    @include('bo.bookroom._script')

@endsection
