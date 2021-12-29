@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Story

                    <a href=" {{ route('stories.index') }}" class="float-right">Back</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('stories.form')


                        <button class="btn btn-primary">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection