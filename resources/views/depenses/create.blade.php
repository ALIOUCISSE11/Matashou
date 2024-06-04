@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Ajouter Dépense</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('depenses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom_produit">Nom du produit</label>
                    <input type="text" name="nom_produit" id="nom_produit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="quantité">Quantité</label>
                    <input type="number" name="quantité" id="quantité" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prix_unitaire">Prix Unitaire</label>
                    <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
