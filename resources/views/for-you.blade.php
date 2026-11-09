@extends('layouts.app')
@section('title', 'Stories picked for you – StoryMuse')

@section('content')
<div class="container pb-5">
    <div class="sm-page-title">
        <h1 class="sm-h2">Stories picked for you</h1>
        <p class="sm-muted sm-measure">Answer four quick questions. Everything is optional.</p>
    </div>

    <form method="GET" action="{{ route('recommendations') }}" class="sm-quiz mb-5" data-auto-submit="off">
        <input type="hidden" name="go" value="1">

        <fieldset class="mb-4">
            <legend class="sm-h3">Which genres do you enjoy?</legend>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($options['genres'] as $genre)
                    <input type="checkbox" class="btn-check" name="genres[]" id="g-{{ Str::slug($genre) }}" value="{{ $genre }}" @checked(in_array($genre, $prefs['genres'] ?? []))>
                    <label class="sm-chip" for="g-{{ Str::slug($genre) }}">{{ $genre }}</label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="sm-h3">What mood are you in?</legend>
            <div class="d-flex flex-wrap gap-2">
                <input type="radio" class="btn-check" name="mood" id="m-any" value="" @checked(empty($prefs['mood']))>
                <label class="sm-chip" for="m-any">Any mood</label>
                @foreach ($options['moods'] as $mood)
                    <input type="radio" class="btn-check" name="mood" id="m-{{ Str::slug($mood) }}" value="{{ $mood }}" @checked(($prefs['mood'] ?? null) === $mood)>
                    <label class="sm-chip" for="m-{{ Str::slug($mood) }}">{{ $mood }}</label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="sm-h3">How long a story?</legend>
            <div class="d-flex flex-wrap gap-2">
                <input type="radio" class="btn-check" name="length" id="l-any" value="" @checked(empty($prefs['length']))>
                <label class="sm-chip" for="l-any">Any length</label>
                @foreach (['short' => 'Short', 'medium' => 'Medium', 'long' => 'Long'] as $v => $l)
                    <input type="radio" class="btn-check" name="length" id="l-{{ $v }}" value="{{ $v }}" @checked(($prefs['length'] ?? null) === $v)>
                    <label class="sm-chip" for="l-{{ $v }}">{{ $l }}</label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="sm-h3">Ongoing or completed?</legend>
            <x-status-filter :current="$prefs['status']" any-value="any" any-label="Any" />
        </fieldset>

        <button class="btn sm-btn sm-btn-primary" type="submit">Show my matches</button>
    </form>

    @if ($results !== null)
        <h2 class="sm-h2 mb-4">Your matches</h2>
        
        <div class="row g-3">
            @foreach ($results as $story)
                <div class="col-md-6 col-lg-4 sm-match-column">
                    <x-story-card :story="$story" />

                    <p class="sm-small sm-muted sm-match-info">
                        <strong>{{ $story->match_score }}% match</strong>
                        @if ($story->match_reasons)
                            · {{ implode(', ', $story->match_reasons) }}
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
