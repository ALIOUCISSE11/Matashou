@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Détails d'un Client</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title">Nom:    {{ $client->nom }}</h5>
            <p class="card-title">Numéro: {{ $client->phone }}</p>
            <p class="card-title">Addresse: {{ $client->adresse }}</p>
            <a href="{{ route('clients.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>
@endsection
