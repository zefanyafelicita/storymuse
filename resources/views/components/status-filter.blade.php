@props(['current' => null, 'name' => 'status', 'anyValue' => '', 'anyLabel' => 'All statuses'])
<div class="d-flex flex-wrap gap-2" role="group" aria-label="Story status">
    @foreach ([$anyValue => $anyLabel, 'ongoing' => 'Ongoing', 'completed' => 'Completed'] as $value => $label)
        <input type="radio" class="btn-check" name="{{ $name }}" id="{{ $name }}-{{ $value ?: 'all' }}" value="{{ $value }}" @checked((string) $current === (string) $value)>
        <label class="sm-chip" for="{{ $name }}-{{ $value ?: 'all' }}">{{ $label }}</label>
    @endforeach
</div>
