<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Client::all();
        $produits=Produit::all();
        $commandes = Commande::latest()->paginate(3);
        return view('commande',[
            'commandes' => $commandes,
            'produits'=>$produits,
            'clients'=>$clients,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients=Client::all();
        $produits=Produit::all();
        return view('addcommande',['clients'=>$clients,
            'produits'=>$produits,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'clients_id' => 'required|exists:clients,id',
            'date' => 'required',
            'products' => 'required|array',
            'products.*.nom' => 'required|exists:produits,id',
            'products.*.quantite' => 'required|integer|min:1',
        ]);

        $commande = new Commande();
        $commande->clients_id = $request->clients_id;
        $commande->date = $request->date;
        $commande->save();

        foreach ($request->products as $product) {
            $commande->produits()->attach($product['nom'], ['quantite' => $product['quantite']]);
        }

        return redirect()->route('commande.index')->with('success', 'Commande ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Commande::find($id);
        return view('showcommande', [
            'commande' => $commande
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produits=Produit::all();
        $clients=Client::all();
        $commande=Commande::find($id);
        return view('commande.edit', [
            'commande' => $commande,
            'clients'=>$clients,
            'produits'=>$produits
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupérer la commande à modifier
        $commande = Commande::findOrFail($id);

        // Mettre à jour les données de la commande
        $commande->client_id = $request->input('client_id');
        $commande->date = $request->input('date');
        $commande->save();

        // Mettre à jour les quantités des produits dans la commande
        foreach ($request->input('quantites') as $produitId => $quantite) {
            $commande->produits()->updateExistingPivot($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('commande.index')->with('success', 'La commande a été modifiée avec');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande=Commande::find($id);
        $commande->delete();
        return to_route('commande.index')->with('success','Commande suprimmée avec succès');
    }
}
