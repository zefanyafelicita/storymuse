@extends('layouts.app')
@section('title', $collection['name'].' – StoryMuse')

@section('content')
<section class="sm-tone-{{ $collection['tone'] }}">
    <div class="container sm-page-title">
        <a href="{{ route('collections.index') }}" class="sm-small">← All collections</a>
        <h1 class="sm-h2 mt-2">{{ $collection['name'] }}</h1>
        <p class="mb-0 sm-measure">{{ $collection['description'] }}</p>
    </div>
</section>

<div class="container py-4">
    @unless ($fixedStatus)
        <form method="GET" action="{{ route('collections.show', $collection['slug']) }}" data-auto-submit class="mb-4">
            <x-status-filter :current="$status" />
        </form>
    @endunless

    @if ($stories->isEmpty())
        <div class="sm-empty"><h3 class="sm-h3">Nothing here yet</h3><a href="{{ route('discover') }}">Browse Discover</a></div>
    @else
        <p class="sm-muted sm-small">{{ $stories->total() }} {{ Str::plural('story', $stories->total()) }}</p>
        <div class="row g-3">
            @foreach ($stories as $story)
                <div class="col-md-6 col-lg-4"><x-story-card :story="$story" /></div>
            @endforeach
        </div>
        <div class="mt-4">{{ $stories->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
