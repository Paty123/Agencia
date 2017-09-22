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

/*Route::get('/',function() 
{return view('welcome');}

	);*/

Route::get('/','MainController@login');
/// user normal

Auth::routes();


Route::resource('productscir', 'CircuitosController');
Route::resource('circuitos', 'CircuitosController');
Route::resource('reserv','salesController');
Route::resource('create','salesController');
Route::resource('tours','toursController');
Route::resource('hotel','hotelController');
Route::resource('ciudades','ciudadesController');
Route::resource('costost','costostController');
Route::resource('departures','departuresController');
Route::resource('sales','salesController');
Route::resource('season','seasonController');
Route::resource('tipohabitaciones','tipohabitacionesController');






Route::get('/home', 'HomeController@index');



/*Route::get('/tours',function() 
{return view('tours');}

	);
*/
Route::get('/hotel',function() 
{return view('hotel');}

	);

Route::get('/fecha',function() 
{return view('fecha');}

	);



Route::get('/catalogo',function() 
{return view('catalogo');}

	);

Route::get('/',array ('as'=>'circuito','uses'=>'CircuitosController@index'));
Route::get('/autocomplete',array('as'=>'autocomplete','uses'=>'CircuitosController@autocomplete'));




Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
//Route::GET('admin','Admin\RegisterController@showRegistrationForm')->name('admin.register'); 
//Route::POST('admin','Admin\RegisterController@register');                         

//}  ); */

 

Route::get('/home', 'HomeController@index');





 Route::prefix('admin')->group(function() {

 
    Route::GET('/admin','Admin\LoginController@showLoginForm')->name('admin.login'); 
    Route::POST('/admin','Admin\LoginController@login');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::resource('circuitos', 'CircuitosController');
    Route::resource('ciudades','ciudadesController');
    Route::resource('tours','toursController');

    

  });
