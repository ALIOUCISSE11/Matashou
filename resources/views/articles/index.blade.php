@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4 text-center" style="background-color: #00ff5573"><strong>LISTE DES ARTICLES</strong></h1>
            <div class="d-flex justify-content-center mb-3">
                
                    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3 btn-center">Créer un nouvel Article</a>
                
                
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3 mx-2">Créer une nouvelle Catégorie</a>
                
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Titre</th>
                        <th>Image</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>

                            <td><img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" width="100"></td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->price }}</td>
                            <td>{{ $article->content }}</td>
                            <td>
                                 <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info">Détails</a>
                                   <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Modifier</a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;" id="deleteForm{{$article->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-article" data-id="{{$article->id}}">Supprimer</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteButtons = document.querySelectorAll('.delete-article');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                let articleId = this.getAttribute('data-id');
                if (confirm('Êtes-vous sûr de vouloir supprimer cet article?')) {
                    document.getElementById('deleteForm' + articleId).submit();
                }
            });
        });
    });
</script>

@endsection


