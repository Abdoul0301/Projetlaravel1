
@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-1 mt-5">
        <div class="card">
            <div class="card-header">
                liste des Utilisateurs
            </div>
            <div class="card-body mt-2">
                <a class="btn btn-success float-end"  href="{{route('utilisateur.create')}}">Ajouter</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uu as $u)
                        <tr>
                            <th scope="row">{{$u->id}}</th>
                            <td>
                                @if($u->image)
                                    <img src="{{ asset('storage/images/'.$u->image) }}" style="height: 50px;width:50px;">
                                @else
                                    <span>No image found!</span>
                                @endif
                            </td>
                            <td>{{$u->lastname}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->genre}}</td>
                            <td>{{$u->email}}</td>


                            <td>
                                <a class="btn btn-primary" href="{{route('utilisateur.edit',$u)}}" >modifier</a>

                                <form action="{{route('utilisateur.destroy',$u)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$uu->links()}}
            </div>
        </div>

    </div>

@endsection
