<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[StaticController::class,"index"])->name('home');
Route::get('/profile',[StaticController::class,"profile"])->name('profile');
Route::get('/admin',[StaticController::class,"admin"])->name('admin');
Route::get('/show/{id}',[StaticController::class,"show"])->where('id','\d+');
Route::post('/profile/store',[StaticController::class,"store"])->name('store');
Route::post('/profile/commant',[StaticController::class,"commant"])->name('commant');
Route::post('/profile/evaluation',[StaticController::class,"evaluation"])->name('evaluation');
Route::post('/profile/inscription',[StaticController::class,"inscription"])->name('inscription');
//
Route::post('/profile/signin',[StaticController::class,"signin"])->name('signin');
Route::post('/profile/connexion',[StaticController::class,"connexion"])->name('connexion');
//
Route::get('/logout',[StaticController::class,"logout"])->name('logout');

Route::get('/back',[StaticController::class,"back"])->name('back');
//supprimer event
Route::get('/supprimer/{id}',[StaticController::class,"supprimer"])->where('id','\d+');
//
Route::get('/supprimeruser/{id}',[StaticController::class,"supprimeruser"])->where('id','\d+');
//modifier
Route::get('/modifier/{id}',[StaticController::class,"modifier"])->where('id','\d+');
Route::put('/modifier',[StaticController::class,"update"])->name('update');
// //filter
// Route::get('/about',function(){
//     $filter=strip_tags(request('style'));
//     if(isset($filter)){
//         return $filter;
//     }else{
//         return 'none';
//     }
    
// });

//category item
// Route::get('/about/{category?}/{item?}',function($category=null,$item=null){
//        return $category . '/'.$item;
// });