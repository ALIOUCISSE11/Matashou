@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Modifier une Catégorie</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
