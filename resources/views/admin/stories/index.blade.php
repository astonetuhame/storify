@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Deleted Stories
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $stories as $story)
                            <tr>
                                <td>
                                    {{ $story->title }}
                                </td>
                                <td>
                                    {{ $story->type}}
                                </td>
                                <td>
                                    {{ $story->user->name}}
                                </td>
                                <td>
                                    <form action=" {{ route('admin.stories.restore', [$story]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="m-1 btn btn-danger">Restore</button>
                                    </form>
                                    <form action=" {{ route('admin.stories.delete', [$story]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="m-1 btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $stories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection