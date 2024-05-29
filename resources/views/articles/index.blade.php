@extends('layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row">
        <div class="col s12">
            <h1 class="mb-4 text-center" style="background-color: #00ff5573"><strong>LIST OF ARTICLES</strong></h1>
            <hr class="mb-3">
            <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3 btn-center">Create New Article</a>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td><img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" width="100"></td>
                        <td>{{ $article->category->name }}</td>
                        <td>{{ $article->content }}</td>
                        <td>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;" id="deleteForm{{$article->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-article" data-id="{{$article->id}}">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('js/delete_confirmation.js') }}"></script>
@endsection

@endsection
