@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Modifier une Commande</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select name="client_id" id="client_id" class="form-control" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $client->id == $commande->client_id ? 'selected' : '' }}>{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="adresse_livraison">Adresse de Livraison</label>
                    <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control" value="{{ $commande->adresse_livraison }}" required>
                </div>
                <div class="form-group">
                    <label for="etat">État</label>
                    <select name="etat" id="etat" class="form-control" required>
                        <option value="en attente" {{ $commande->etat == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en cours" {{ $commande->etat == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="livré" {{ $commande->etat == 'livré' ? 'selected' : '' }}>Livré</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="articles">Articles</label>
                    @foreach($articles as $article)
                        <div class="form-check">
                            <input type="checkbox" name="articles[{{ $article->id }}][article_id]" value="{{ $article->id }}"
                                {{ $commande->articles->contains($article->id) ? 'checked' : '' }} class="form-check-input">
                            <label class="form-check-label">{{ $article->nom }}</label>
                            <input type="number" name="articles[{{ $article->id }}][quantite]" min="1" value="{{ $commande->articles->contains($article->id) ? $commande->articles->find($article->id)->pivot->quantite : 1 }}" class="form-control" style="width: 100px;">
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
