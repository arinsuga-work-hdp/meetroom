@extends('layouts.appbo')

@section('content_title', 'Dashboard')

@section('toolbar')
@endsection

@section('control_sidebar')
@endsection

@section('content')

    <div style="margin-top: 10px;">

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ruang Meeting Postmo</h3>
                  <a href="{{ route('bookpostmo.create') }}">Booking Meeting</a>
                </div>
              </div>
              <div class="card-body">
                    @include('bo.dashboard.index-items-postmo')
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ruang Meeting Faried</h3>
                  <a href="{{ route('bookpostmo.create') }}">Booking Meeting</a>
                </div>
              </div>
              <div class="card-body">
                    @include('bo.dashboard.index-items-faried')
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ruang Meeting Founder</h3>
                  <a href="{{ route('bookfounder.create') }}">Booking Meeting</a>
                </div>
              </div>
              <div class="card-body">
                    @include('bo.dashboard.index-items-founder')
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ruang Meeting Interior</h3>
                  <a href="{{ route('bookinterior.create') }}">Booking Meeting</a>
                </div>
              </div>
              <div class="card-body">
                    @include('bo.dashboard.index-items-interior')
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ruang Meeting Bulat</h3>
                  <a href="{{ route('bookbulat.create') }}">Booking Meeting</a>
                </div>
              </div>
              <div class="card-body">
                    @include('bo.dashboard.index-items-rbulat')
              </div>
            </div>
            <!-- /.card -->

    </div>


@endsection

@section('js')

    @include('bo.dashboard._script')

@endsection
