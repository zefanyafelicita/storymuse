@props(['title', 'href' => null, 'action' => 'See all'])
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <h2 class="sm-h2 mb-2">{{ $title }}</h2>
        @if (trim((string) $slot) !== '')
            <p class="sm-muted mb-0 sm-measure">{{ $slot }}</p>
        @endif
    </div>
    @if ($href)
        <a href="{{ $href }}" class="btn sm-btn sm-btn-ghost">{{ $action }}</a>
    @endif
</div>
