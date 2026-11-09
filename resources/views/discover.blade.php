@extends('layouts.app')
@section('title', 'Discover – StoryMuse')

@section('content')
<div class="container">
    <div class="sm-page-title">
        <h1 class="sm-h2">Discover</h1>
        <p class="sm-muted sm-measure">Search the catalogue and combine filters: status, genre, trope, mood, ending and rating.</p>
    </div>

    <form method="GET" action="{{ route('discover') }}" data-auto-submit class="d-grid gap-3 mb-4">
        <div class="row g-2">
            <div class="col-lg-5">
                <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control sm-input" placeholder="Search title, author or trope" aria-label="Search stories" data-debounce>
            </div>
            <div class="col-lg-3 col-6">
                <select name="sort" class="form-select sm-input" aria-label="Sort">
                    @foreach ($sorts as $key => $label)
                        <option value="{{ $key }}" @selected(($filters['sort'] ?? 'gem') === $key)>Sort: {{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <x-status-filter :current="$filters['status'] ?? ''" />

        <div class="row g-2">
            @php
                $selects = [
                    ['genre', 'Genre', $options['genres']],
                    ['trope', 'Trope', $options['tropes']],
                    ['mood', 'Mood', $options['moods']],
                ];
            @endphp
            @foreach ($selects as [$name, $label, $items])
                <div class="col-lg-2 col-6">
                    <select name="{{ $name }}" class="form-select sm-input" aria-label="{{ $label }}">
                        <option value="">{{ $label }}: any</option>
                        @foreach ($items as $item)
                            <option value="{{ $item }}" @selected(($filters[$name] ?? null) === $item)>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <div class="col-lg-2 col-6">
                <select name="ending" class="form-select sm-input" aria-label="Ending">
                    <option value="">Ending: any</option>
                    @foreach (['happy' => 'Happy', 'bittersweet' => 'Bittersweet', 'open' => 'Open'] as $v => $l)
                        <option value="{{ $v }}" @selected(($filters['ending'] ?? null) === $v)>{{ $l }} ending</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-6">
                <select name="min_rating" class="form-select sm-input" aria-label="Rating">
                    <option value="">Rating: any</option>
                    @foreach (['4' => '4.0 and up', '4.5' => '4.5 and up'] as $v => $l)
                        <option value="{{ $v }}" @selected((string) ($filters['min_rating'] ?? '') === (string) $v)>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <noscript><button class="btn sm-btn sm-btn-primary">Apply filters</button></noscript>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="sm-muted sm-small mb-0">{{ $stories->total() }} {{ Str::plural('story', $stories->total()) }}</p>
        @if (count($filters))
            <a href="{{ route('discover') }}" class="sm-small">Clear all filters</a>
        @endif
    </div>

    @if ($stories->isEmpty())
        <div class="sm-empty"><h3 class="sm-h3">No stories match yet</h3><p class="sm-muted mb-0">Remove a filter or try a different search.</p></div>
    @else
        <div class="row g-3">
            @foreach ($stories as $story)
                <div class="col-md-6 col-lg-4 col-xl-3"><x-story-card :story="$story" :show-score="true" /></div>
            @endforeach
        </div>
        <div class="mt-4">{{ $stories->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
