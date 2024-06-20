<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('client', 'articles')->paginate(5);
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
    $clients = Client::all();
    $articles = Article::all();
    return view('commandes.create', compact('clients', 'articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'articles' => 'required|array',
            'articles.*.article_id' => 'required|exists:articles,id',
            'articles.*.quantite' => 'required|integer|min:1',
            'adresse_livraison' => 'required|string',
        ]);

        $commande = Commande::create([
            'client_id' => $request->client_id,
            'prix_total' => 0, // Calculer plus tard
            'etat' => Commande::ETAT_EN_ATTENTE,
            'adresse_livraison' => $request->adresse_livraison,
        ]);

        $prix_total = 0;
        foreach ($request->articles as $articleData) {
            $article = Article::find($articleData['article_id']);
            $commande->articles()->attach($article->id, ['quantite' => $articleData['quantite']]);
            $prix_total += $article->price * $articleData['quantite'];
        }

        $commande->update(['prix_total' => $prix_total]);

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        $clients = Client::all();
        $articles = Article::all();
        return view('commandes.edit', compact('commande', 'clients', 'articles'));
    }

    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'articles' => 'required|array',
            'articles.*.article_id' => 'required|exists:articles,id',
            'articles.*.quantite' => 'required|integer|min:1',
            'adresse_livraison' => 'required|string',
            'etat' => 'required|in:en attente,en cours,livré',
        ]);

        $commande->update([
            'client_id' => $request->client_id,
            'adresse_livraison' => $request->adresse_livraison,
            'etat' => $request->etat,
        ]);

        $commande->articles()->detach();
        $prix_total = 0;
        foreach ($request->articles as $articleData) {
            $article = Article::find($articleData['article_id']);
            $commande->articles()->attach($article->id, ['quantite' => $articleData['quantite']]);
            $prix_total += $article->price * $articleData['quantite'];
        }

        $commande->update(['prix_total' => $prix_total]);

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
    }

    public function updateStatus(Request $request, Commande $commande)
{
    $request->validate([
        'etat' => 'required|in:en attente,en cours,livré',
    ]);

    $commande->etat = $request->etat;
    $commande->save();

    return redirect()->route('commandes.index')->with('success', 'État de la commande mis à jour avec succès.');
}


    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'date_saisie' => 'required|date',
        ]);

        $dateRecherche = Carbon::parse($request->input('date_saisie'))->format('Y-m-d');
        $commandes = Commande::whereDate('created_at', $dateRecherche)->paginate(10);
        $totalPrix = $commandes->sum('prix_total');

        // Stocker la date de recherche et le total des prix dans la session
        session([
            'date_recherche' => $dateRecherche,
            'total_prix_recherche' => $totalPrix,
        ]);

        return view('commandes.index', compact('commandes', 'totalPrix'));
    }

    public function annulerRecherche()
    {
        // Supprimer la date de recherche et le total des prix de la session
        session()->forget(['date_recherche', 'total_prix_recherche', 'mois_recherche', 'total_prix_mois']);

        // Rediriger vers la page d'index des commandes
        return redirect()->route('commandes.index')->with('success', 'Recherche annulée avec succès.');
    }

    public function searchByMonth(Request $request)
    {
        session()->forget(['date_recherche', 'total_prix_recherche', 'mois_recherche', 'total_prix_mois']);

        $request->validate([
            'search_month' => 'required|date_format:Y-m',
        ]);

        $searchMonth = Carbon::parse($request->input('search_month'));
        $commandes = Commande::whereYear('created_at', $searchMonth->year)
            ->whereMonth('created_at', $searchMonth->month)
            ->paginate(10);
        $totalPrix = $commandes->sum('prix_total');

        // Stocker le mois de recherche et le total des prix dans la session
        session([
            'mois_recherche' => $searchMonth->format('Y-m'),
            'total_prix_mois' => $totalPrix,
        ]);

        return view('commandes.index', compact('commandes', 'totalPrix'));
    }

}
