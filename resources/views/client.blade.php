
@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-1 mt-5">
        <div class="card">
            <div class="card-header">
                liste des Clients
            </div>
            <div class="card-body mt-2">
                <a class="btn btn-success float-end"  href="{{route('client.create')}}">Ajouter</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cc as $c)
                        <tr>
                            <th scope="row">{{$c->id}}</th>
                            <td>{{$c->nom}}</td>
                            <td>{{$c->prenom}}</td>
                            <td>{{$c->adresse}}</td>
                            <td>{{$c->tel}}</td>
                            <td>{{$c->genre}}</td>

                            <td>
                                <a class="btn btn-primary" href="{{route('client.edit',$c)}}" >modifier</a>

                                <form action="{{route('client.destroy',$c)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$cc->links()}}
            </div>
        </div>

    </div>
@endsection
