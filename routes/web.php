<?php

use App\Http\Controllers\Client\Journal\ClientJournalBasicController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Could be in separate route file and registered in RouteService Provider
Route::group(['middleware' => 'auth', 'prefix' => 'clients'], function (): void {
    Route::get('/', 'ClientsController@index')->name('clients.index');
    Route::get('/create', 'ClientsController@create');
    Route::post('/', 'ClientsController@store');
    Route::group(['middleware' => 'clientIsUsers'], function (): void {
        Route::middleware('clientIsUsers')->get('/{client}', 'ClientsController@show');
        Route::middleware('clientIsUsers')->delete('/{client}', 'ClientsController@destroy');
        Route::get('/{client}/journals', 'JournalsController@index');
        Route::post('/{client}/journals', 'JournalsController@store');
        Route::delete('/{client}/journals/{journal}', 'JournalsController@destroy');
        Route::get('/{client}/journal/{journal}', [ClientJournalBasicController::class,'show']);
    });
});
