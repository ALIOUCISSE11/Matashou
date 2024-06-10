@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Clients</h1>
        </div>
        <div class="card-body">
           
            <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Ajouter un Client</a>
        
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Numéro de Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->adresse }}</td>
                            <td>
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Détails</a>
                           
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                       
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Supprimer</button>
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
