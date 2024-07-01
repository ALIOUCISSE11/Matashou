<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
        ]);
    
        $client = Client::create([
            'nom' => $request->nom,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
        ]);
    
        // Retourne le client créé
        return response()->json($client);
    }
    

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function search(Request $request)
{
    $search = $request->input('search');
    
    $clients = Client::where('nom', 'like', '%' . $search . '%')
                     ->orWhere('phone', 'like', '%' . $search . '%')
                     ->take(5)  // Limite le nombre de résultats
                     ->get();
    
    return response()->json($clients);
}
}
