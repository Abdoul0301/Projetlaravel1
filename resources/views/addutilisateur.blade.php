@extends('layouts.app')

@section('content')
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                {{$uu->exists ?"modifier":"ajouter"}} utilisateur
            </div>
            <div class="card-body">
                <form   action="{{route( $uu->exists ? 'utilisateur.update' : 'utilisateur.store',$uu) }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method($uu->exists ?"put":"post")

                    <label for="">Photo</label>
                    <input type="file"   class="form-control @error("image") is-invalid @enderror" id="image" name="image" value="{{$uu->image }}">
                    @error("image")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <img src="{{$uu->image ? asset('storage/images/'.$uu->image) : asset('storage/images/defaut.jpg') }}" class="img-fluid img-thumbnail" width="100"> <br>



                    <label for="">Nom</label>
                    <input type="text" class="form-control @error("lastname") is-invalid @enderror" id="lastname" name="lastname" value="{{$uu->lastname ? $uu->lastname : old('lastname')}}">
                    @error("lastname")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">Prenom</label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{$uu->name ? $uu->name : old('name')}}">
                    @error("name")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror




                    <label for="">Genre</label>
                    <input type="text"   class="form-control @error("genre") is-invalid @enderror" id="genre" name="genre" value="{{$uu->genre ? $uu->genre : old('genre')}}">
                    @error("genre")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror




                    <label for="">Email</label>
                    <input type="text"   class="form-control @error("email") is-invalid @enderror" id="email" name="email" value="{{$uu->email ? $uu->email : old('email')}}">
                    @error("email")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror


                    <label for="">Mot de passe</label>
                    <input type="password"   class="form-control @error("password") is-invalid @enderror" id="password" name="password" value="{{$uu->password ? $uu->password : old('password')}}">
                    @error("password")
                    <div class = "invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror



                    <br>
                    <div class="modal-footer">
                        <a href="{{ route('utilisateur.index') }}" class="btn btn-secondary" >Fermer</a>
                        <button  type="submit" class="btn btn-primary"  >{{$uu->exists ?"modifier":"ajouter"}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div>

@endsection
