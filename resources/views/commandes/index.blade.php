@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Liste des Commandes</h1>

    @if(session('date_recherche'))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <div>
                Commandes effectuées le {{ \Carbon\Carbon::parse(session('date_recherche'))->format('d/m/Y') }}
                <br>
                Total des prix : {{ session('total_prix_recherche') }} CFA
            </div>
            <form action="{{ route('commandes.annulerRecherche') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger">Annuler la recherche</button>
            </form>
        </div>
    @elseif(session('mois_recherche'))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <div>
                Commandes effectuées en {{ \Carbon\Carbon::parse(session('mois_recherche'))->formatLocalized('%B %Y') }}
                <br>
                Total des prix : {{ session('total_prix_mois') }} CFA
            </div>
            <form action="{{ route('commandes.annulerRecherche') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger">Annuler la recherche</button>
            </form>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('commandes.recherche') }}" method="POST" class="mb-3">
                @csrf
                <div class="form-group">
                    <label for="date_saisie">Rechercher par date :</label>
                    <input type="date" name="date_saisie" id="date_saisie" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('commandes.rechercheMois') }}" method="POST" class="mb-3">
                @csrf
                <div class="form-group">
                    <label for="search_month">Rechercher par mois :</label>
                    <input type="month" name="search_month" id="search_month" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('commandes.create') }}" class="btn btn-primary">Ajouter Commande</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Client</th>
                <th>Adresse Livraison</th>
                <th>Articles</th>
                <th>Prix Total</th>
                <th>Etat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->client->nom }}</td>
                    <td>{{ $commande->adresse_livraison }}</td>
                    <td>
                        <ul>
                            @foreach($commande->articles as $article)
                                <li>{{ $article->title }} ({{ $article->pivot->quantite }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $commande->prix_total }}</td>
                    <td>
                        <form action="{{ route('commandes.updateStatus', $commande->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="etat" class="form-control" onchange="this.form.submit()">
                                <option value="en attente" {{ $commande->etat == 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en cours" {{ $commande->etat == 'en cours' ? 'selected' : '' }}>En cours</option>
                                <option value="livré" {{ $commande->etat == 'livré' ? 'selected' : '' }}>Livré</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $commandes->links() }}
    </div>
</div>
@endsection
