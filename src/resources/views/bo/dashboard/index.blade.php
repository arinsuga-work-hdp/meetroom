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
                  <h3 class="card-title">Lantai Basement</h3>
                </div>
              </div>
              <div class="card-body">
                    <div class="row">
                        <a href="{{ route('bookbulat.create') }}">Booking Ruang Interior</a>
                        <div class="col-md-12">@include('bo.dashboard.index-items-interior')</div>
                    </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Lantai 1</h3>
                </div>
              </div>
              <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-body">

                              <a href="{{ route('bookfaried.create') }}">Booking Ruang Faried</a>
                              @include('bo.dashboard.index-items-faried')

                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-body">

                              <a href="{{ route('bookpostmo.create') }}">Booking Ruang Postmo</a>
                              @include('bo.dashboard.index-items-postmo')
                              
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                          <div class="card">
                            <div class="card-body">

                              <a href="{{ route('bookpostmo.create') }}">Booking Ruang Bulat</a>
                              @include('bo.dashboard.index-items-rbulat')
                              
                            </div>
                          </div>
                        </div>
                        
                    </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Lantai 2</h3>
                </div>
              </div>
              <div class="card-body">
                    <div class="row">
                        <a href="{{ route('bookbulat.create') }}">Booking Ruang Founder</a>
                        <div class="col-md-12">@include('bo.dashboard.index-items-founder')</div>
                    </div>
              </div>
            </div>
            <!-- /.card -->
            

    </div>


@endsection

@section('js')

    @include('bo.dashboard._script')

@endsection
