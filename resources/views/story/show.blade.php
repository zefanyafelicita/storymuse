@extends('layouts.app')
@section('title', $story->title.' – StoryMuse')
@section('description', $story->summary)

@section('content')
@php use Illuminate\Support\Number; @endphp
<div class="container pb-5">
    <div class="sm-page-title">
        <a href="{{ route('discover') }}" class="sm-small">← Back to Discover</a>
        <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
            <x-status-badge :status="$story->status" :large="true" />
            @if ($story->is_hidden_gem)<span class="sm-badge sm-badge-gem sm-badge-lg">Hidden gem</span>@endif
            <span class="sm-small sm-muted">{{ $story->status_info }}@if ($story->ending) · {{ ucfirst($story->ending) }} ending @endif</span>
        </div>
        <h1 class="sm-h1 mt-3" style="font-size:clamp(2rem,5vw,3rem)">{{ $story->title }}</h1>
        <p class="sm-muted mb-0">by {{ $story->author }} · {{ $story->genre }} · {{ $story->chapters }} chapters</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <p class="fs-5">{{ $story->summary }}</p>
            <div class="d-flex flex-wrap gap-2 mb-4">
                @foreach ($story->tropes as $trope)
                    <a class="sm-badge text-decoration-none" href="{{ route('discover', ['trope' => $trope]) }}">{{ $trope }}</a>
                @endforeach
                @if ($story->mood)<span class="sm-badge">{{ $story->mood }}</span>@endif
                <span class="sm-badge">{{ ucfirst($story->length_band) }} read</span>
            </div>
            @if ($story->why_notable)
                <div class="sm-why"><strong>Why it’s worth a look.</strong> {{ $story->why_notable }}</div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="sm-card">
                <div class="sm-stats flex-wrap">
                    <span>{{ Number::abbreviate($story->reads, maxPrecision: 1) }} reads</span>
                    <span>{{ Number::abbreviate($story->votes, maxPrecision: 1) }} votes</span>
                    <span>{{ round($story->vote_rate * 100) }}% vote rate</span>
                    <span>★ {{ number_format($story->rating, 1) }}</span>
                </div>
                <p class="sm-small sm-muted mb-0">Gem score: <strong>{{ (int) round($gemScore) }}</strong> / 100</p>
                @if ($story->wattpad_verified && $story->wattpad_url)
                    <a class="btn sm-btn sm-btn-primary" href="{{ $story->wattpad_url }}" target="_blank" rel="noopener noreferrer">Read on Wattpad</a>
                @else
                    <button class="btn sm-btn sm-btn-primary" disabled>Wattpad link not verified yet</button>
                @endif
                <p class="sm-small sm-muted mb-0">StoryMuse links to the original story only once it’s verified. Chapters aren’t hosted here.</p>
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <section class="mt-5">
            <x-section-heading title="More {{ $story->genre }} stories" />
            <div class="row g-3">
                @foreach ($related as $r)
                    <div class="col-md-6 col-lg-4"><x-story-card :story="$r" /></div>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
