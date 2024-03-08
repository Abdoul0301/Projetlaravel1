
@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-1 mt-5">

        <div class="card">
            <div class="card-header">
                liste des Categories
            </div>
            <div class="card-body">

                <a class="btn btn-success mt-2 float-end"  href="{{route('cat.create')}}">Ajouter</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ct as $c)
                        <tr>
                            <th scope="row">{{$c->id}}</th>
                            <td>{{$c->libelle}}</td>
                            <td>
                                <a  class="btn btn-primary" href="{{route('cat.edit',$c)}}">modifier</a>
                                <form action="{{route('cat.destroy',$c)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">supprimer</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$ct->links()}}
            </div>
        </div>
    </div>
@endsection
