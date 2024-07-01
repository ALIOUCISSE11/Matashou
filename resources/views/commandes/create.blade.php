@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center mb-0">Créer une Commande</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="client_search">Rechercher ou Créer un Client</label>
                    <div class="input-group">
                        <input type="text" id="client_search" class="form-control" placeholder="Rechercher un Client...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" id="create-client-btn">Créer Client</button>
                        </div>
                    </div>
                    <div id="client_search_results"></div>
                </div>
                <div class="form-group new-client-fields" style="display: none;">
                    <label>Nouveau Client</label>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="client_id" id="client_id">
                <div class="form-group">
                    <label for="adresse_livraison">Adresse de Livraison</label>
                    <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control" required>
                </div>
                <div class="articles-container">
                    <div class="article-group">
                        <div class="form-group">
                            <label for="article_1">Article</label>
                            <select name="articles[1][article_id]" id="article_1" class="form-control" required>
                                <option value="">Sélectionner un Article</option>
                                @foreach($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantite_1">Quantité</label>
                            <input type="number" name="articles[1][quantite]" id="quantite_1" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="add-article">Ajouter un Article</button>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Créer</button>
                    <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let typingTimer;
    const doneTypingInterval = 500; // Délai en ms après la fin de la saisie

    $('#client_search').on('input', function () {
        clearTimeout(typingTimer);
        let searchQuery = $(this).val().trim();

        if (searchQuery.length > 0) {
            typingTimer = setTimeout(function() {
                searchClient(searchQuery);
            }, doneTypingInterval);
        } else {
            $('#client_search_results').empty();
        }
    });

    $('#client_search').on('keypress', function (e) {
        if (e.which === 13) { // 13 est le code de la touche Entrée
            e.preventDefault();
            let searchQuery = $(this).val().trim();
            if (searchQuery.length > 0) {
                searchClient(searchQuery, true);
            }
        }
    });

    function searchClient(query, showCreatePrompt = false) {
        $.ajax({
            url: '{{ route("clients.search") }}',
            method: 'GET',
            data: { search: query },
            success: function (response) {
                let results = '';
                if (response.length > 0) {
                    results = '<ul class="list-group">';
                    response.forEach(function (client) {
                        results += `<li class="list-group-item client-item" data-client-id="${client.id}">${client.nom} - ${client.phone}</li>`;
                    });
                    results += '</ul>';
                    $('#client_search_results').html(results);
                } else {
                    if (showCreatePrompt) {
                        alert("Ce client n'existe pas. Veuillez remplir toutes les informations du client.");
                        $('.new-client-fields').show();
                        $('#nom').val(query);
                    } else {
                        results = `
                            <div class="alert alert-info" role="alert">
                                Ce client n'existe pas encore dans la base. 
                                <button type="button" class="btn btn-primary btn-sm ml-2" id="create-new-client-btn">Créer ce client</button>
                            </div>
                        `;
                        $('#client_search_results').html(results);
                    }
                }
            },
            error: function (error) {
                console.error('Error fetching clients:', error);
            }
        });
    }

    $('#client_search_results').on('click', '.client-item', function () {
        let clientId = $(this).data('client-id');
        $('#client_id').val(clientId);
        $('#client_search').val($(this).text());
        $('#client_search_results').empty();
        $('.new-client-fields').hide();
    });

    $('#client_search_results').on('click', '#create-new-client-btn', function () {
        $('.new-client-fields').show();
        $('#nom').val($('#client_search').val());
    });

    $('#create-client-btn').click(function () {
        $('.new-client-fields').toggle();
    });

    $('form').on('submit', function (e) {
    e.preventDefault();
    
    if ($('#client_id').val()) {
        // Client existant sélectionné
        this.submit();
    } else {
        // Vérifier si les champs du nouveau client sont visibles
        if ($('.new-client-fields').is(':visible')) {
            // Créer un nouveau client
            let nom = $('#nom').val().trim();
            let phone = $('#phone').val().trim();
            let adresse = $('#adresse').val().trim();

            if (nom && phone && adresse) {
                $.ajax({
                    url: '{{ route("clients.store") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nom: nom,
                        phone: phone,
                        adresse: adresse
                    },
                    success: function (response) {
                        $('#client_id').val(response.id);
                        $('form').submit();
                    },
                    error: function (error) {
                        console.error('Error creating client:', error);
                        alert('Erreur lors de la création du client. Veuillez réessayer.');
                    }
                });
            } else {
                alert('Veuillez remplir tous les champs du nouveau client.');
            }
        } else {
            // Aucun client sélectionné et pas de nouveau client en cours de création
            alert('Veuillez sélectionner un client existant ou créer un nouveau client.');
        }
    }
});

        $('#add-article').click(function () {
            const container = $('.articles-container');
            const index = container.find('.article-group').length + 1;
            const newArticle = `
                <div class="article-group">
                    <div class="form-group">
                        <label for="article_${index}">Article</label>
                        <select name="articles[${index}][article_id]" id="article_${index}" class="form-control" required>
                            <option value="">Sélectionner un Article</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantite_${index}">Quantité</label>
                        <input type="number" name="articles[${index}][quantite]" id="quantite_${index}" class="form-control" required>
                    </div>
                </div>
            `;
            container.append(newArticle);
        });
    });
</script>
@endpush