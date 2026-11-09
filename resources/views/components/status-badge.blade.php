@props(['status', 'large' => false])
<span {{ $attributes->class(['sm-badge', $status->badgeClass(), 'sm-badge-lg' => $large]) }}>{{ $status->label() }}</span>
