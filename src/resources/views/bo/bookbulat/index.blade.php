@extends('layouts.appbo')

@section('content_title', 'Ruang Bulat Booking List')

@section('style')

<style>
    
</style>

@endsection

@section('toolbar')

<li class="nav-item">
    <a class="nav-link" href="{{ route('bookbulat.create') }}">
        <i class="fas fa-lg fa-plus"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" data-widget="control-sidebar" href="#" >
        <i class="fas fa-lg fa-filter"></i>
    </a>
</li>

@endsection

@section('control_sidebar')
    <div class="control-sidebar-content">
        @include('bo.bookbulat.data-list-filters')
    </div>
@endsection

@section('content')

        <nav class="navbar navbar-expand ">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookbulat.index.today') }}" style="font-weight: bold;">
                        Today
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookbulat.index.open') }}" style="font-weight: bold;">
                        Open
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookbulat.index.custom') }}" style="font-weight: bold;">
                        Custom
                    </a>
                </li>

                <li class="nav-item" style="border-bottom: 5px solid red;">
                    <a class="nav-link" href="{{ route('bookbulat.index') }}" style="font-weight: bold;">
                        All
                    </a>
                </li>

            </ul>

        </nav>


        <div>
            @include('bo.bookbulat.data-list-items')
        </div>

@endsection

@section('js')

@endsection
