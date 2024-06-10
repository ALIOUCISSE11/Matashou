@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Créer un Article</h1>
        </div>
        <div class="card-body">
          
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie</label>
                        <select name="category_id" id="category" class="form-control" required>
                            <option value="">Sélectionner une Catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Créer</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </form>
            @else
                <div class="alert alert-danger text-center">
                    Vous n'avez pas la permission de créer un article.
                </div>
         
        </div>
    </div>
</div>
@endsection
