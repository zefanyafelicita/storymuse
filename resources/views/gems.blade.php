@extends('layouts.app')
@section('title', 'Hidden Gems – StoryMuse')

@section('content')
<section class="sm-band-lavender">
    <div class="container sm-page-title">
        <h1 class="sm-h2">Hidden Gems</h1>
        <p class="sm-measure mb-0">Stories with under {{ number_format($gem['max_reads']) }} reads and unusually engaged readers. Each gets a score out of 100 from vote rate, rating and how little-known it is.</p>
    </div>
</section>

<div class="container py-4">
    <form method="GET" action="{{ route('gems') }}" data-auto-submit class="mb-4">
        <x-status-filter :current="$filters['status'] ?? ''" />
    </form>

    @if ($stories->isEmpty())
        <div class="sm-empty"><h3 class="sm-h3">No hidden gems with this status yet</h3><a href="{{ route('gems') }}">Show all statuses</a></div>
    @else
        <div class="row g-3">
            @foreach ($stories as $story)
                <div class="col-md-6 col-lg-4"><x-story-card :story="$story" :show-score="true" /></div>
            @endforeach
        </div>
        <div class="mt-4">{{ $stories->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
