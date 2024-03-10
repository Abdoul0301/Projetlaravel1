<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class AnaliseController extends Controller
{
    public function index()
    {

        $totalClients = Client::count();
        $totalProduits = Produit::count();
        $nbClientsMasculin = Client::where('genre', 'masculin')->count();
        $nbClientsFeminin = Client::where('genre', 'feminin')->count();

        return view('analise', [
            'totalClients' => $totalClients,
            'totalProduits' => $totalProduits,
            'nbClientsMasculin' => $nbClientsMasculin,
            'nbClientsFeminin' => $nbClientsFeminin,
        ]);
    }
}
