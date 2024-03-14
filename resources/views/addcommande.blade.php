
@extends('layouts.app')

@section('content')

    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                Faire une commande
            </div>
            <div class="card-body">
                <form   action="{{route('commande.store') }}" method="post">
                    @csrf
                    @method("post")


                    <!-- Champs pour les informations de la commande (nom, adresse, etc.) -->
                    <div class="row">
                        <div class="col">
                            <label>Prénom & Nom</label>
                            <select type="text" name="clients_id" class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->prenom}} {{$client->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                    <br>
                    <!-- Conteneur pour les détails des produits -->
                    <div class="row" id="product-details">
                        <!-- Champs pour le premier produit -->
                        <div class="product">
                            <label>Nom Produit:</label>
                            <select type="text" class="" name="products[0][nom]" >
                                @foreach($produits as $produit)
                                    <option value="{{$produit->id}}">{{$produit->nom}}</option>
                                @endforeach
                            </select>
                            <label>Quantite</label>
                            <input type="number" name="products[0][quantite]" placeholder="Quantité">
                            <!-- Autres champs pour les détails du produit -->
                            <button type="button" class="remove-product btn btn-danger">Supprimer</button>
                            <br>
                        </div>
                    </div>
                    <button type="button"  class="btn btn-warning" id="add-product">Ajouter un produit</button>
                    <!-- Bouton de soumission du formulaire -->




                    <br>
                    <div class="modal-footer">
                        <a href="{{ route('commande.index') }}" class="btn btn-secondary" >Fermer</a>
                        <button  type="submit" class="btn btn-primary"  >Passer la commande</button>
                    </div>
                </form>

            </div>
        </div>
        <div>


            <script>
                document.getElementById('add-product').addEventListener('click', function() {
                    // Créer un nouveau champ de produit et l'ajouter au formulaire
                    var productContainer = document.getElementById('product-details');
                    var productIndex = productContainer.querySelectorAll('.product').length;
                    var options=[
                        @foreach($produits as $produit)
                            '<option value="{{$produit->id}}">{{$produit->nom}}</option>',
                        @endforeach
                    ]
                    var newProduct = document.createElement('div');
                    newProduct.classList.add('product');
                    newProduct.innerHTML = `
           <label for="">Nom Produit</label>
           <select name="products[${productIndex}][nom]">
                ${options}
           </select>
            <label for="">Quantite</label>
            <input type="number" name="products[${productIndex}][quantite]" placeholder="Quantite">
            <!-- Autres champs pour les détails du produit -->
            <button type="button" class="remove-product btn btn-danger">Supprimer</button>
        `;

                    productContainer.appendChild(newProduct);

                });
                // Gérer la suppression d'un champ de produit
                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-product')) {
                        event.target.closest('.product').remove();
                    }
                });
            </script>
@endsection
