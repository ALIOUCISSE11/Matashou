@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Modifier un Article</h1>
        </div>
        <div class="card-body">
           
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie</label>
                        <select name="category_id" id="category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $article->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea name="content" id="content" class="form-control" rows="4" required>{{ $article->content }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Modifier</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Quitter</a>
                    </div>
           
        </div>
    </div>
</div>
@endsection
