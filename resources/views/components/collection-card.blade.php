@props(['collection'])
<a href="{{ route('collections.show', $collection['slug']) }}" class="sm-card sm-collection-card sm-tone-{{ $collection['tone'] }} h-100 text-decoration-none">
    <h3 class="sm-h3 mb-0">{{ $collection['name'] }}</h3>
    <p class="mb-0 sm-small">{{ $collection['description'] }}</p>
    @isset($collection['count'])
        <span class="sm-small">{{ $collection['count'] }} {{ Str::plural('story', $collection['count']) }}</span>
    @endisset
</a>
