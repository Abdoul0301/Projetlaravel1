
@extends('layouts.app')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                {{$ct->exists ?"modifier":"ajouter"}} classe
            </div>
            <div class="card-body">
                <form   action="{{route( $ct->exists ? 'cat.update' : 'cat.store',$ct) }}" method="post">
                    @csrf
                    @method($ct->exists ?"put":"post")


                    <label for="">Libelle</label>
                    <input type="text" class="form-control @error("libelle") is-invalid @enderror" id="libelle" name="libelle" value="{{$ct->libelle ? $ct->libelle : old('libelle')}}">
                    @error("libelle")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror




                    <br>
                    <div class="modal-footer">
                        <a href="{{ route('cat.index') }}" class="btn btn-secondary" >Fermer</a>
                        <button  type="submit" class="btn btn-primary"  >{{$ct->exists ?"modifier":"ajouter"}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
@endsection
