
@extends('layouts.app')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                {{$pp->exists ?"modifier":"ajouter"}} produit
            </div>
            <div class="card-body">
                <form   action="{{route( $pp->exists ? 'produit.update' : 'produit.store',$pp) }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method($pp->exists ?"put":"post")

                    <label for="">Photo</label>
                    <input type="file"   class="form-control @error("photo") is-invalid @enderror" id="photo" name="photo" value="{{$pp->photo }}">
                    @error("photo")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <img src="{{$pp->photo ? asset('storage/images/'.$pp->photo) : asset('storage/images/defaut.jpg') }}" class="img-fluid img-thumbnail" width="100"> <br>



                    <label for="">Nom</label>
                    <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom" value="{{$pp->nom ? $pp->nom : old('nom')}}">
                    @error("nom")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">Description</label>
                    <input type="text" class="form-control @error("desc") is-invalid @enderror" id="desc" name="desc" value="{{$pp->desc ? $pp->desc : old('desc')}}">
                    @error("desc")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror




                    <label for="">prix</label>
                    <input type="number"   class="form-control @error("prix") is-invalid @enderror" id="prix" name="prix" value="{{$pp->prix ? $pp->prix : old('prix')}}">
                    @error("prix")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror



                    <label for="">quantité en stock</label>
                    <input type="number"   class="form-control @error("qtstock") is-invalid @enderror" id="qtstock" name="qtstock" value="{{$pp->qtstock ? $pp->qtstock : old('qtstock')}}">
                    @error("qtstock")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">catégorie</label>
                    <select class="form-control" id="categorie_id @error("categorie_id") is-invalid @enderror" name="categorie_id" value="{{$pp->categorie_id ? $pp->categorie_id : old('categorie_id')}}">
                        @error("categorie_id")
                        <div class = "invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror


                        <option value="">selectionner un catégorie</option>
                        @foreach($ct as $c)
                            <option @selected($pp->categorie_id == $c->id) value="{{$c->id}}">{{$c->libelle}}</option>
                        @endforeach
                    </select>




                    <br>
                    <div class="modal-footer">
                        <a href="{{ route('produit.index') }}" class="btn btn-secondary" >Fermer</a>
                        <button  type="submit" class="btn btn-primary"  >{{$pp->exists ?"modifier":"ajouter"}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
@endsection
