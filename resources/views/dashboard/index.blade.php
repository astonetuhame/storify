@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Home Page</h1>
        <p class="lead text-muted">Great Stories from our Author</p>
        <p>
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary my-2">All</a>
            <a href="{{ route('dashboard.index', ['type' => 'short']) }}" class="btn btn-secondary my-2">Short</a>
            <a href="{{ route('dashboard.index', ['type' => 'long']) }}" class="btn btn-secondary my-2">Long</a>
        </p>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            @foreach( $stories as $story)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <a href="{{ route('dashboard.show', [$story] ) }}">
                        <img class="card-img-top" src="{{ $story->thumbnail}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <p class="card-text">{{ $story->title }}</p>
                        <br />
                        @foreach ( $story->tags as $tag )
                        <button class="btn btn-sm btn-outline-primary">
                            {{ $tag->name }}
                        </button>
                        @endforeach
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary">{{$story->user->name}}</button>
                            </div>
                            <small class="text-muted">{{ $story->type}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{ $stories->withQueryString()->links() }}
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
@endsection