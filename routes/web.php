<?php

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
 Route::get('/',"HomeController@index")->name('home');
 Route::get('/contacte','HomeController@contacte')->name('contacte');
 Route::get('/noticies',"HomeController@noticies")->name('noticies');
 Route::get('/promocions',"HomeController@promocions")->name('promocions');
 Route::get('/atraccions',"HomeController@atraccions")->name('atraccions');
 Route::get('/atraccions_generades/{id}',"HomeController@llistarAtraccionsPublic")->name('atraccions_generades');
 Route::get('/entrades',"HomeController@entrades")->name('entrades');
 Route::get('/gestio',"HomeController@gestio")->name('gestio')->middleware(['auth','is_admin','verified']);
 Route::get('/perfil',"HomeController@perfil")->name('perfil')->middleware(['auth','verified']);
 Route::get('/incidencia',"HomeController@incidencia")->name('incidencia')->middleware(['auth','verified']);
 Route::get('/pizzeria',"HomeController@pizzeria")->name('pizzeria');
 Route::get('/form',"HomeController@form")->name('form');

 /* RUTES GRUP 1 */
 Auth::routes(['verify' => true]);

 Route::post('/incidencia', 'HomeController@store_incidencia')->name('incidencia')->middleware(['auth','verified']);
 //Route::get('/home', 'HomeController@index')->name('home');

 Route::get('gestio/incidencies/assign', 'IncidenciesController@assigned')->name('incidencies.assign');

 Route::resource('gestio/incidencies', 'IncidenciesController')->middleware(['auth','is_admin','verified']);

 Route::resource('gestio/empleats', 'EmpleatsController')->middleware(['auth','is_admin','verified']);

 Route::resource('gestio/zones', 'ZonesController')->middleware(['auth','is_admin','verified']);

 Route::resource('gestio/serveis', 'ServeisController')->middleware(['auth','is_admin','verified']);

 Route::get('promocions/promocio_x', ['as' => 'promocio_x', function(){
   $title = "Promoció X";
   return view ('/promocio_x', compact('title'));
 }]);

 /* RUTES GRUP 2 */

 Route::any('/gestio/atraccions/crearassignaciomantenimentdate/{id}', 'AtraccionsController@crearAssignacioMantenimentDate')->name('atraccions.crearassignaciomantenimentdate');

 Route::get('/gestio/atraccions/crearassignaciomanteniment/{id}', 'AtraccionsController@crearAssignacioManteniment')->name('atraccions.crearassignaciomanteniment');

 Route::any('/gestio/atraccions/crearassignacioneteja/{id}', 'AtraccionsController@crearAssignacioNeteja')->name('atraccions.crearassignacioneteja');

 Route::any('/gestio/atraccions/crearassignaciogeneral/{id}', 'AtraccionsController@crearAssignacioGeneral')->name('atraccions.crearassignaciogeneral');

 Route::post('/gestio/atraccions/crearassignaciomanteniment/guardar/{id}', 'AtraccionsController@guardarAssignacio')->name('atraccions.guardarAssignacio');

 Route::any('/gestio/atraccions/assigna', 'AtraccionsController@assigna')->name('atraccions.assigna');

 Route::any('/gestio/atraccions/assignacions', 'AtraccionsController@assignacions')->name('atraccions.assignacions');
 Route::any('/gestio/atraccions/assignacions/editAssignacions/{id}', 'AtraccionsController@editAssignacions')->name('atraccions.assignacions.editAssignacions');
 Route::any('/gestio/atraccions/assignacions/updateAssignacions/{id}', 'AtraccionsController@updateAssignacions')->name('atraccions.assignacions.updateAssignacions');
 Route::any('/gestio/atraccions/assignacions/destroy', 'AtraccionsController@destroyAssignacions')->name('atraccions.assignacions.destroy');


 Route::resource('/gestio/atraccions', 'AtraccionsController')->middleware(['auth','is_admin','verified']);

 Route::get('/gestio/atraccions/image', 'AtraccionsController@store')->name('image.upload')->middleware(['auth','is_admin','verified']);

 Route::post('/gestio/atraccions/image', 'AtraccionsController@store')->name('image.upload.post')->middleware(['auth','is_admin','verified']);

 Route::resource('/gestio/clients', 'ClientsController')->middleware(['auth','is_admin','verified']);



 /* Guardar PDF */
 Route::get('/view/atraccions/index', 'AtraccionsController@guardarPDF');

 /* gestio imatges */
 Route::get("/gestio/imatges", "ImageController@create")->name('imatges.create')->middleware(['auth','is_admin','verified']);
 Route::post("/gestio/imatges/save", "ImageController@save")->name('imatges.save')->middleware(['auth','is_admin','verified']);

 /* Part Jose */
 Route::post('/entrades', array('as' => 'entrades','uses' => 'HomeController@parc_afegir_cistella'));
 Route::resource('/gestio/productes', 'gestioProductes')->middleware(['auth','is_admin','verified']);
 Route::resource('/gestio/ventes', 'VentesController')->middleware(['auth','is_admin','verified']);

 Route::get('/cistella', 'HomeController@cistella')->name('cistella')->middleware(['auth','verified']);
 Route::delete('/cistella', 'HomeController@cistella_delete')->name('cistella')->middleware(['auth','verified']);
 Route::get('/compra', 'HomeController@compra')->name('compra')->middleware(['auth','verified']);
 Route::get('/compra_finalitzada', 'HomeController@compra_finalitzada')->name('compra_finalitzada')->middleware(['auth','verified']);

 /*Tenda*/
  Route::get('/tenda', 'TendaController@indexTenda')->name('tenda');
  Route::get('/tenda/atraccions', 'TendaController@indexAtraccions')->name('tendaFotos');
  Route::get('/imprimirFotos/{id}','TendaController@imprimirFotos');
  Route::get('/comprarFotos/{id}','HomeController@comprarFotos');
