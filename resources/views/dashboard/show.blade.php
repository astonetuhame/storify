@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $story->title }} by {{ $story->user->name}}

                    <a href=" {{ route('dashboard.index') }}" class="float-right">Back</a>
                </div>

                <div class="card-body">
                    <img class="card-img-top" src="{{ $story->thumbnail}}" alt="Card image cap">
                    <!-- {{ $story->body}}

                    <p class="font-italic">{{ $story->footnote}}</p> -->
                    <p class="card-text">{{ $story->body }}</p>
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
    </div>
</div>
@endsection