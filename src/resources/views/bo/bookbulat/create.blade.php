@extends('layouts.appbo')

@section('content_title', 'Booking Ruang Bulat')

@section('toolbar')

<li class="nav-item">
    <a class="nav-link" href="{{ route('bookbulat.index') }}">
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

<form role="form" id="frmData" method="POST" action="{{ route('bookbulat.store') }}" enctype="multipart/form-data">
    @csrf

    @if ($errors->first('custom') !== '')

        <div class="alert alert-danger alert-dismissible" style="width: 50%;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <p>{{$errors->first('custom')}}</p>
        </div>

    @endif

    <div style="display: flex; justify-content=center;">
        @include('bo.bookbulat.data-field-items')
    </div>
</form>

@endsection

@section('js')

    @include('bo.bookbulat._script')

@endsection
