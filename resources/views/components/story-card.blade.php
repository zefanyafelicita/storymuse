@props(['story', 'showScore' => false])
@php use Illuminate\Support\Number; @endphp
<a href="{{ route('stories.show', $story) }}" class="sm-card sm-story-card text-decoration-none" aria-label="View {{ $story->title }}">
    <div class="sm-cover sm-cover-{{ $story->cover_tone }}">{{ $story->genre }}</div>
    <div class="d-flex flex-wrap gap-2">
        <x-status-badge :status="$story->status" />
        @if ($story->is_hidden_gem)
            <span class="sm-badge sm-badge-gem">Hidden gem</span>
        @endif
        @if ($story->mood)
            <span class="sm-badge">{{ $story->mood }}</span>
        @endif
    </div>
    <h3 class="sm-h3 mb-0">{{ $story->title }}</h3>
    <div class="sm-small sm-muted">by {{ $story->author }}</div>
    <p class="sm-summary sm-muted mb-0">{{ $story->summary }}</p>
    <div class="sm-stats mt-auto">
        <span>{{ Number::abbreviate($story->reads, maxPrecision: 1) }} reads</span>
        <span>{{ Number::abbreviate($story->votes, maxPrecision: 1) }} votes</span>
        <span>★ {{ number_format($story->rating, 1) }}</span>
        @if ($showScore && $story->gem_score !== null)
            <span>Gem score {{ (int) round($story->gem_score) }}</span>
        @endif
    </div>
</a>
