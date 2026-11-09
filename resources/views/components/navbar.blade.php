@php
    $links = [
        ['home', 'Home'],
        ['discover', 'Discover'],
        ['gems', 'Hidden Gems'],
        ['recommendations', 'For You'],
        ['collections.index', 'Collections'],
    ];
@endphp
<header class="sm-header sticky-top">
    <nav class="navbar navbar-expand-lg" aria-label="Main">
        <div class="container">
            <a class="sm-logo navbar-brand" href="{{ route('home') }}"><i class="sm-logo-mark"></i>StoryMuse</a>
            <button class="navbar-toggler sm-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-lg-auto gap-lg-1">
                    @foreach ($links as [$name, $label])
                        <li class="nav-item">
                            <a class="nav-link sm-nav-link @if (request()->routeIs($name === 'collections.index' ? 'collections.*' : $name)) active @endif"
                               href="{{ route($name) }}" @if (request()->routeIs($name === 'collections.index' ? 'collections.*' : $name)) aria-current="page" @endif>{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
                <a class="btn sm-btn sm-btn-primary mt-3 mt-lg-0" href="{{ route('recommendations') }}">Get recommendations</a>
            </div>
        </div>
    </nav>
</header>
