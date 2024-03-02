<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ct = Categorie::paginate(2);
        return view('cat',['ct'=>$ct]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ct = new Categorie();
        return view('addcat',['ct'=>$ct]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
        ]);

        $ct = new Categorie();
        $ct-> libelle =$request["libelle"];
        $ct-> save();

        return to_route('cat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ct = new Categorie();
        return view('addcat',['ct'=>$ct->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'libelle' => 'required'
        ]);

        $ct = Categorie::find($id);
        $ct-> libelle = $request["libelle"];
        $ct-> save();

        return to_route('cat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categorie::destroy($id);
        return to_route('cat.index');
    }
}
