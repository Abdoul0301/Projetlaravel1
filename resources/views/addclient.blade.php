
@extends('layouts.app')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                {{$cc->exists ?"modifier":"ajouter"}} client
            </div>
            <div class="card-body">
                <form   action="{{route( $cc->exists ? 'client.update' : 'client.store',$cc) }}" method="post">
                    @csrf
                    @method($cc->exists ?"put":"post")


                    <label for="">Nom</label>
                    <input type="text" class="form-control @error("nom") is-invalid @enderror" id="nom" name="nom" value="{{$cc->nom ? $cc->nom : old('nom')}}">
                    @error("nom")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">Prenom</label>
                    <input type="text" class="form-control @error("prenom") is-invalid @enderror" id="prenom" name="prenom" value="{{$cc->prenom ? $cc->prenom : old('prenom')}}">
                    @error("prenom")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror



                    <label for="">Adresse</label>
                    <input type="text"   class="form-control @error("adresse") is-invalid @enderror" id="adresse" name="adresse" value="{{$cc->adresse ? $cc->adresse : old('adresse')}}">
                    @error("adresse")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">Téléphone</label>
                    <input type="number"   class="form-control @error("tel") is-invalid @enderror" id="tel" name="tel" value="{{$cc->tel ? $cc->tel : old('tel')}}">
                    @error("tel")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="">Genre</label>
                    <input type="text"   class="form-control @error("genre") is-invalid @enderror" id="genre" name="genre" value="{{$cc->genre ? $cc->genre : old('genre')}}">
                    @error("genre")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror



                    <br>
                    <div class="modal-footer">
                        <a href="{{ route('client.index') }}" class="btn btn-secondary" >Fermer</a>
                        <button  type="submit" class="btn btn-primary"  >{{$cc->exists ?"modifier":"ajouter"}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
@endsection
