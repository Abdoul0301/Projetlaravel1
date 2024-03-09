<?php

namespace App\Http\Controllers;

use App\Models\produitExport;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produit = Produit::paginate(2);
        return view('produit',['pp'=>$produit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pp = new produit();
        return view('addproduit',['pp'=>$pp,'ct'=>Categorie::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required',
            'qtstock' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);




        $fileName = time() . '.' . $request->photo->extension();
        $request->photo->storeAs('public/images', $fileName);



        $pp = new produit();
        $pp-> photo =$fileName;
        $pp-> nom = $request["nom"];
        $pp-> desc = $request["desc"];
        $pp-> prix = $request["prix"];
        $pp-> qtstock = $request["qtstock"];
        $pp-> categorie_id = $request["categorie_id"];
        $pp-> save();

        return to_route('produit.index');
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
        $pp = new produit();
        return view('addproduit',['pp'=>$pp->find($id),'ct'=>Categorie::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required',
            'qtstock' => 'required'

        ]);


        $pp = Produit::find($id);

        $imageName = '';

        if ($request->hasFile('photo')){
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images' , $imageName);

            if ($pp->photo){
                Storage::delete('public/images/' . $pp->photo);
            }
        } else {
            $imageName = $pp->photo;
        }

        $pp-> photo =$imageName;
        $pp-> nom = $request["nom"];
        $pp-> desc = $request["desc"];
        $pp-> prix = $request["prix"];
        $pp-> qtstock = $request["qtstock"];
        $pp-> categorie_id = $request["categorie_id"];
        $pp-> save();


        return to_route('produit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produit::destroy($id);
        return to_route('produit.index');
    }
    public function downloadExcel()
    {
        return Excel::download(new produitExport(), 'listeproduit.xlsx');

    }
}
