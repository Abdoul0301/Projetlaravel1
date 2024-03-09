
@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-1 mt-5">
        <div class="card">
            <div class="card-header">
                liste des Produits
            </div>
            <div class="card-body mt-2">
                <a class="btn btn-success float-end"  href="{{route('produit.create')}}">Ajouter</a>
                <a class="btn btn-secondary float-end"  href="{{route('produitexcel')}}">Excel</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité en stock</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col" width="280px" >Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pp as $p)
                        <tr>
                            <th scope="row">{{$p->id}}</th>
                            <td>
                                @if($p->photo)
                                    <img src="{{ asset('storage/images/'.$p->photo) }}" style="height: 50px;width:50px;">
                                @else
                                    <span>No image found!</span>
                                @endif
                            </td>
                            <td>{{$p->nom}}</td>
                            <td>{{$p->desc}}</td>
                            <td>{{$p->prix}}</td>
                            <td>{{$p->qtstock}}</td>
                            <td>{{$p->categorie->libelle}}</td>


                            <td>
                                <a class="btn btn-primary" href="{{route('produit.edit',$p)}}" >modifier</a>

                                <form action="{{route('produit.destroy',$p)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$pp->links()}}
            </div>
        </div>

    </div>
@endsection
