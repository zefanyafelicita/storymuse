@extends('layouts.app')
@section('title', 'Collections – StoryMuse')

@section('content')
<div class="container pb-5">
    <div class="sm-page-title">
        <h1 class="sm-h2">Collections</h1>
        <p class="sm-muted sm-measure">Hand-picked groups of stories around a feeling, a theme or a status.</p>
    </div>
    <div class="row g-3">
        @foreach ($collections as $collection)
            <div class="col-md-6 col-lg-4"><x-collection-card :collection="$collection" /></div>
        @endforeach
    </div>
</div>
@endsection
