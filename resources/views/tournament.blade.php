@extends('layouts.app')

@section('title','Tournament '.$tournament->getTranslatedAttribute('title'))

@section('content')

  <div class="profile-page">
    <div class="page-header page-header-small position-relative">
      <div class="page-header-image" style="background-image: url({{ asset('frontend/assets/img/header-bg.jpg') }});"></div>
      <div class="container text-center position-relative" style="z-index: 2;">
        <img class="img-fluid img-center" src="{{ is_null($tournament->logo) ? asset('frontend/assets/img/default.png') : Voyager::image($tournament->logo) }}" alt="tournament logo">
        <h1 class="title">{{ $tournament->getTranslatedAttribute('title') }}</h1>
        <ul class="list-unstyled text-center">
          <li class="list-inline-item"><i class="fas fa-map"></i> {{ $tournament->venue }}</li>
          <li class="list-inline-item"><i class="fas fa-clock"></i> {{ date('d F, Y H:i:s', strtotime($tournament->date)) }}</li>
          <li class="list-inline-item"><i class="fas fa-money-bill-wave"></i> $ {{ $tournament->getTranslatedAttribute('prize') }} USD</li>
        </ul>
      </div>
    </div>

    {{-- Bouton juste au-dessus de About --}}
    <div class="container my-4 text-center">
      <a href="{{ route('register.form') }}" class="btn btn-primary btn-lg">
        S'inscrire au tournoi
      </a>
    </div>

    <div class="section">
      <div class="container">
        <h2 class="title mb-5">About</h2>
        <div class="row mb-5">
          <div class="col-md-8 ml-auto mr-auto text-center">
            {!! \Purifier::clean($tournament->getTranslatedAttribute('about')) !!}
          </div>
        </div>
        <div class="stats row text-center align-items-center d-flex justify-content-center">
          <div class="col-sm-2">
            <p class="stats-details text-success">{{ $tournament->groups }}</p>
            <p>Groups</p>
          </div>
          <div class="col-sm-2">
            <p class="stats-details text-success">{{ count($tournament->teams) }}</p>
            <p>Teams</p>
          </div>
          <div class="col-sm-2">
            <p class="stats-details text-success">{{ $tournament->players }}</p>
            <p>Players</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('sections.live-streams')

@endsection
