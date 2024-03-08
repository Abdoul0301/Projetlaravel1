<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::paginate(2);
        return view('client',['cc'=>$client]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cc = new client();
        return view('addclient',['cc'=>$cc]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
        ]);



        $cc = new client();
        $cc-> nom =$request["nom"];
        $cc-> prenom = $request["prenom"];
        $cc-> adresse = $request["adresse"];
        $cc-> tel = $request["tel"];
        $cc-> genre = $request["genre"];
        $cc-> save();

        return to_route('client.index');
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
        $cc = new client();
        return view('addclient',['cc'=>$cc->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'adresse' => 'required',
            'genre' => 'required',

        ]);


        $cc = Client::find($id);
        $cc-> nom =$request["nom"];
        $cc-> prenom = $request["prenom"];
        $cc-> adresse = $request["adresse"];
        $cc-> tel = $request["tel"];
        $cc-> genre = $request["genre"];
        $cc-> save();


        return to_route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Client::destroy($id);
        return to_route('client.index');
    }

    public function downloadPdf()
    {
        $pdf = PDF::loadView('clientpdf');

        return $pdf->download('listeclient.pdf');
    }
}
