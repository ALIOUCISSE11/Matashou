@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Dépenses</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('depenses.create') }}" class="btn btn-primary mb-3">Ajouter Dépense</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom du produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Prix Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($depenses as $depense)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $depense->nom_produit }}</td>
                            <td>{{ $depense->quantité }}</td>
                            <td>{{ $depense->prix_unitaire }}</td>
                            <td>{{ $depense->prix_total }}</td>
                            <td>
                                <a href="{{ route('depenses.show', $depense->id) }}" class="btn btn-info">Détails</a>
                                <a href="{{ route('depenses.edit', $depense->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('depenses.destroy', $depense->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
