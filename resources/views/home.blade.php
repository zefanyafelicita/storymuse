@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <section class="sm-hero">
        <div class="container">
            <h1 class="sm-h1">Discover stories<br>beyond the spotlight.</h1>
            <p class="sm-lead sm-muted">StoryMuse helps you find underrated Wattpad stories that deserve more readers, matched to what you love.</p>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn sm-btn sm-btn-primary" href="{{ route('recommendations') }}">Find my next story</a>
                <a class="btn sm-btn sm-btn-ghost" href="{{ route('gems') }}">Browse hidden gems</a>
            </div>
        </div>
    </section>

    {{-- Status shortcuts --}}
    <section class="sm-section pb-0">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('discover', ['status' => 'ongoing']) }}" class="sm-card sm-tone-peach h-100 text-decoration-none">
                        <h3 class="sm-h3 mb-0">Explore Ongoing Stories</h3>
                        <p class="sm-muted mb-0">Follow stories that are still being written.</p>
                        <span class="sm-small">{{ $ongoingCount }} stories</span>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('discover', ['status' => 'completed']) }}" class="sm-card sm-tone-lavender h-100 text-decoration-none">
                        <h3 class="sm-h3 mb-0">Explore Completed Stories</h3>
                        <p class="sm-muted mb-0">Read from the first chapter to the final one.</p>
                        <span class="sm-small">{{ $completedCount }} stories</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="sm-section">
        <div class="container">
            <x-section-heading title="How StoryMuse works">We guide you to the story. You read it on Wattpad.</x-section-heading>
            <div class="sm-how row g-3">
                @foreach ([
                    ['Tell us your taste', 'Pick genres, mood, length and status.'],
                    ['See what fits', 'Get a short list with a clear reason for each pick.'],
                    ['Read the original', 'Follow the link to the author’s story on Wattpad when it’s verified.'],
                ] as [$title, $text])
                    <div class="col-md-4">
                        <div class="sm-how-item h-100">
                            <h3 class="sm-h3">{{ $title }}</h3>
                            <p class="sm-muted sm-small mb-0">{{ $text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Hidden gems --}}
    <section class="sm-section sm-band-lavender">
        <div class="container">
            <x-section-heading title="Hidden gems this week" :href="route('gems')">Highly loved by the few who found them.</x-section-heading>
            <div class="row g-3">
                @forelse ($gems as $story)
                    <div class="col-md-6 col-lg-4"><x-story-card :story="$story" /></div>
                @empty
                    <p class="sm-muted">No hidden gems yet. Run <code>php artisan migrate --seed</code>.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Collections --}}
    <section class="sm-section">
        <div class="container">
            <x-section-heading title="Curated collections" :href="route('collections.index')" action="All collections" />
            <div class="row g-3">
                @foreach ($collections as $collection)
                    <div class="col-md-4"><x-collection-card :collection="$collection" /></div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
