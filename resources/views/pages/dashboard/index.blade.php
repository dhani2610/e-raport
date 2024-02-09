@extends('layouts.main')

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Dashboard</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      @foreach ($data as $item)
        <div class="col-lg-3 col-6">
          <div class="small-box {{ $item['colour'] }}">
            <div class="inner">
              <h3>{{ $item['count'] }}</h3>
              <p>{{ $item['title'] }}</p>
            </div>
            <a href="{{ route($item['route']) }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      @endforeach
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3></h3>
            <p>Profil</p>
          </div>
          <a href="{{ route('profil.index') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')

@endsection
