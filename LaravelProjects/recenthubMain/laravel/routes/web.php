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

Route::get('/', 'PageController@getHome')->name('anasayfa');
Route::get('/new/{kategori}', 'PageController@getCategorie')->name('kategori-haberleri');

Route::get('/new/{kategori}/{haber}', 'PageController@getNew')->name('haber');

Route::get('contact','PageController@getContact')->name('contact');

Route::post('contact', 'PostController@contact')->name('iletisim');
Route::get('search', 'PageController@search');

Route::get('privacypolicy', function(){
    return view ('pages.privacypolicy');
})->name('privacy-policy');

Route::get('sitemap', 'SiteMapController@createSiteMap');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth','admin'],'prefix'=>'admin'], function () {
   
    Route::get('/home', 'Admin\GetController@getAdminAnasayfa')->name('admin-anasayfa');
    Route::get('/haberKategoriler', 'Admin\GetController@getHaberKategoriler')->name('haberler');
    Route::get('haberler/{kategoriId}','Admin\GetController@getHaberler');
    Route::get('addHaber/{kategoriId}','Admin\GetController@addHaber');
    Route::get('editHaber/{haberId}','Admin\GetController@editHaber');



    Route::post('addKategori','Admin\AddController@addKategori');
    Route::post('editKategori','Admin\EditController@editKategori');
    Route::post('addHaber','Admin\AddController@addHaber');
    Route::post('deleteHaber','Admin\DeleteController@deleteHaber');
   



    

});




