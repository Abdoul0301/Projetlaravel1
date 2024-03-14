<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

//utilisateur
Route::resource('utilisateur',\App\Http\Controllers\UserController::class);

//client
Route::resource('client',\App\Http\Controllers\ClientController::class);
Route::get('/clientpdf',[\App\Http\Controllers\ClientController::class,'downloadPdf'])->name("clientpdf");


//produit
Route::resource('produit',\App\Http\Controllers\ProduitController::class);
Route::get('/produitexcel',[\App\Http\Controllers\ProduitController::class,'downloadExcel'])->name("produitexcel");



//categorie
Route::resource('cat',\App\Http\Controllers\CategorieController::class);


//Analyse
Route::get('/analise',[\App\Http\Controllers\AnaliseController::class,'index'])->name("analise");


//commande
Route::resource('commande',\App\Http\Controllers\CommandeController::class);
