<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses = Depense::orderBy('id', 'asc')->get();
        return view('depenses.index', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'quantité' => 'required|integer',
            'prix_unitaire' => 'required|numeric',
        ]);

        Depense::create($request->all());

         // Réorganiser les IDs des livreurs
         $this->reorganizeIds();

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès.');
    }


    // Méthode pour réorganiser les IDs des livreurs
    private function reorganizeIds()
    {
        $depenses = Depense::all();
        $counter = 1;
        foreach ($depenses as $depense) {
            $depense->id = $counter;
            $depense->save();
            $counter++;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        // Réorganiser les IDs des livreurs
        $this->reorganizeIds();

        return view('depenses.show', compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        // Réorganiser les IDs des livreurs
        $this->reorganizeIds();
        
        return view('depenses.edit', compact('depense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'quantité' => 'required|integer',
            'prix_unitaire' => 'required|numeric',
        ]);

        $depense->update($request->all());

        // Réorganiser les IDs des livreurs
        $this->reorganizeIds();

        return redirect()->route('depenses.index')->with('success', 'Dépense mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        $depense->delete();

        // Réorganiser les IDs des livreurs
        $this->reorganizeIds();

        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès.');
    }
}
