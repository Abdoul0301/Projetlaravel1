<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateur = User::paginate(2);
        return view('utilisateur',['uu'=>$utilisateur]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uu = new user();

        return view('addutilisateur',['uu'=>$uu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {





        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);



        $uu = new user();
        $uu-> image =$fileName;
        $uu-> name = $request["name"];
        $uu-> lastname = $request["lastname"];
        $uu-> genre = $request["genre"];
        $uu-> email = $request["email"];
        $uu-> password = Hash::make($uu);;
        $uu-> save();

        return to_route('utilisateur.index');
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
        $uu = new user();
        return view('addutilisateur',['uu'=>$uu->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $uu = User::find($id);

        $imageName = '';

        if ($request->hasFile('image')){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images' , $imageName);

            if ($uu->image){
                Storage::delete('public/images/' . $uu->image);
            }
        } else {
            $imageName = $uu->image;
        }

        $uu-> image = $imageName;
        $uu-> name = $request["name"];
        $uu-> lastname = $request["lastname"];
        $uu-> genre = $request["genre"];
        $uu-> email = $request["email"];
        $uu-> password = Hash::make($uu);;
        $uu-> save();



        return to_route('utilisateur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return to_route('utilisateur.index');
    }
}
