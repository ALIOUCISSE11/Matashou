@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">{{ $category->name }}</h1>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="image">Image</label>
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mx-2">Modifier</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-2">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
