<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/foto', function() {
	$foto = App\Http\Models\Foto::wherePetaId(1)->get();

	foreach ($foto as $q) {
		if (File::exists(public_path().'/'.$q->url_foto)) {
            unlink(public_path().'/'.$q->url_foto);
            //echo $q->url_foto;
        }
	}
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('login', function() {
	return view('layouts.login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function()
{
	Route::get('dashboard', function()
	{
		return view('admin.dashboard');
	});
	Route::get('cari-kecamatan/{id}', ['uses' => 'ApiController@carikecamatan']);
	Route::get('peta', ['uses' => 'PetaController@index']);
	Route::get('peta/tambah', ['uses' => 'PetaController@create']);
	Route::post('peta/tambah', ['uses' => 'PetaController@store']);
	Route::get('peta/{slug}', ['uses' => 'PetaController@show']);
	Route::get('peta/ubah/{slug}', ['uses' => 'PetaController@edit']);
	Route::put('peta/ubah/{id}', ['uses' => 'PetaController@update']);
	Route::delete('peta/hapus/{id}', ['uses' => 'PetaController@destroy']);
	Route::get('lokasi', ['uses' => 'RegionController@index']);
	Route::get('lokasi/{slug}', ['uses' => 'RegionController@show']);
	Route::get('lokasi/cagar-budaya/{slug}', ['uses' => 'RegionController@kabupatencagarbudaya']);
	Route::get('lokasi/kecamatan/{slug}', ['uses' => 'RegionController@kecamatancagarbudaya']);
	Route::get('kategori', ['uses' => 'KategoriController@index']);
	Route::get('kategori/{slug}', ['uses' => 'KategoriController@show']);
	Route::post('foto/upload', ['uses' => 'FotoController@store']);
	Route::post('foto/hapus', ['uses' => 'FotoController@delete']);
});

Route::group(['middleware' => 'apikey', 'prefix' => 'api/v1/service'], function()
{
	Route::get('peta', ['uses' => 'ApiController@peta']);
	Route::get('peta/cari', ['uses' => 'ApiController@caripeta']);
	Route::get('peta/terdekat', ['uses' => 'ApiController@terdekat']);
	Route::get('kategori', ['uses' => 'ApiController@kategori']);
	Route::get('kategori/{id}', ['uses' => 'ApiController@petakategori']);
	Route::get('kabupaten', ['uses' => 'ApiController@kabupaten']);
	Route::get('kabupaten/peta/{id}', ['uses' => 'ApiController@petakabupaten']);
	Route::get('kabupaten/{id}', ['uses' => 'ApiController@showkabupaten']);
	Route::get('kecamatan', ['uses' => 'ApiController@kecamatan']);
	Route::get('kecamatan/{id}', ['uses' => 'ApiController@petakecamatan']);
});