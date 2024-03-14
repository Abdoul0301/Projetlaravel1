@extends('layouts.app')

@section('content')
<div class="col-md-10 offset-1 mt-5">

<div class="card">
<div class="card-header">
    <div class="container">

        <h2>Commande {{ $commande->id }}</h2>
        <p><strong>Client:</strong> {{ $commande->client->prenom }} {{ $commande->client->nom }}</p>
        <p><strong>Telephone:</strong>{{ $commande->client->tel }} </p>
        <p><strong>Adresse:</strong> {{$commande->client->adresse}}</p>
        <p><strong>Date:</strong> {{ $commande->date }}</p>
        <table class="table">
            <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->prix }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ $produit->prix * $produit->pivot->quantite }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                <td>{{ $commande->calculerMontantTotal() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
                <a href="{{ route('commande.index') }}" class="btn btn-secondary" >Fermer</a>
</div>
</div>
</div>

    <style>
        .hidden {
            display: none;
        }
    </style>


@endsection
