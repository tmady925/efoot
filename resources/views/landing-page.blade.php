@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="wrapper">
    <!-- Hero Section Begin -->
    <section class="hero-section set-bg" data-setbg="{{ setting('hero.image') ? Voyager::image(setting('hero.image')) : asset('frontend/assets/img/header-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hs-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hs-text text-center">
                                        <h4>{{ setting('hero.small_title') ?? 'eSports Gaming' }}</h4>
                                        <h2>{{ setting('hero.large_title') ?? 'We organize esports tournament' }}</h2>
                                        <a href="{{ url('/tournaments') }}" class="btn btn-lg btn-info">See Tournaments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Match Section Begin -->
    @include('sections.matches')
    <!-- Match Section End -->

    <!-- News Feed Begin -->
    @if ($latest_posts->count())
        <section class="latest-news-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <h3 class="title">News Feed</h3>
                        <hr class="line-info">
                    </div>
                </div>
                <div class="row">
                    @foreach ($latest_posts as $post)
                        <div class="col-lg-3 col-sm-6 p-0">
                            <div class="latest-news-item set-bg" data-setbg="{{ $post->image ? Voyager::image($post->image) : asset('frontend/assets/img/default.png') }}">
                                <div class="si-tag">
                                    {{ optional($post->category)->getTranslatedAttribute('name', app()->getLocale(), 'en') ?? 'Uncategorized' }}
                                </div>
                                <div class="si-text">
                                    <h5><a href="{{ url('/post/' . $post->slug) }}">{{ $post->getTranslatedAttribute('title', app()->getLocale(), 'en') }}</a></h5>
                                    <ul class="m-0 p-0">
                                        <li><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</li>
                                        <li><i class="fa fa-user"></i> {{ $post->authorId->name ?? 'Admin' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- News Feed End -->

    <!-- Players Section Begin -->
    @include('sections.players')
    <!-- Players Section End -->

    <!-- Live Streams Section Begin -->
    @include('sections.live-streams')
    <!-- Live Streams Section End -->

    <!-- Testimonials Section Begin -->
    @include('sections.testimonial')
    <!-- Testimonials Section End -->
</div>
@endsection

@section('javascript')
    <script src="{{ asset('frontend/assets/custom-js/main.js') }}"></script>
@endsection
