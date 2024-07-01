@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Ajouter un Client</h1>
        </div>
        <div class="card-body">
         
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Numéro:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
            </form>
           
           
        </div>
    </div>
</div>
@endsection
