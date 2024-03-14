@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-1 mt-5">

        <div class="card">
            <div class="card-header">
                Facture de commande
            </div>
            <div class="card-body">
              <a href="{{ route('commande.create') }}" class="btn btn-success mt-2 float-end" > Ajouter une commande</a>



            <br>
            @foreach($commandes as $commande)
                <div>
                    <strong>#</strong> {{ $commande->id }}<br>
                    <strong>Nom Prenom:</strong> {{ $commande->client->prenom }} {{ $commande->client->nom }}<br>
                    <strong>Adresse:</strong> {{ $commande->client->adresse }}<br>
                    <strong>Téléphone:</strong> {{ $commande->client->tel }}<br>
                    <strong>Date de commande:</strong> {{ $commande->date }}<br>
                </div>
                <br>
                <table>
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commande->produits as $produit)
                        <tr>
                            <td >{{ $produit->nom }}</td>
                            <td>{{ $produit->prix }}</td>
                            <td>{{ $produit->pivot->quantite }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <form action="{{ route('commande.destroy', $commande->id) }}" method="post">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cette commande ?');"><i class="bi bi-trash"></i> Supprimer</button>
                    <a href="{{route('commande.show',$commande->id)}}">voir</a>
                </form>

        <hr>
    @endforeach

    {{ $commandes->links() }}
</div>
</div>
</div>


    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
@endsection
