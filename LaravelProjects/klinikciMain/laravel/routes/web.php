<?php

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

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
// get group belirlendi ve gerekli yönlendirmeler yapıldı
// Route::get('/deneme', function () {
//     return view('components.anasayfa-spotlar');
// });

Route::group([], function () {

Route::get('/privacypolicy',function(){
    return view('privacy-policy');

})->name('privacy-policy');

Route::get('/privacypolicy-tr',function(){
    return view('privacy-policy-tr');

})->name('privacy-policy-tr');

// face twitter google girişleri için ayarlamalar
Route::get('login/{network}', 'Auth\LoginController@redirectToProvider')->name('loginRequest');

Route::get('login/{network}/callback', 'Auth\LoginController@handleProviderCallback');
// face twitter google girişleri için ayarlamalar

Route::get('sitemap','SiteMapController@createSiteMap');


Route::get('/home', 'PagesGetController@getHome')->name('home');

    
Route::get('/','PagesGetController@getHome')->name('anasayfa');

Route::get('/iletisim','PagesGetController@getIletisim')->name('iletisim');

// Route::get('/hakkimizda','PagesGetController@getHakkimizda')->name('hakkimizda');

Route::get('/uyeProfil', 'PagesGetController@getProfile')->middleware('auth');

Route::post('/uyeProfil', 'PagesPostController@editProfil')->middleware('auth');

Route::get('/getProfilImage/{uyeId}', 'PagesGetController@getProfilImage')->name('profilResim');




// haberlerin route gruplandırıldı

Route::group(['prefix' => 'haber'], function () {

    Route::get('','PagesGetController@getHaberlerAnasayfa')->name('haber-anasayfa');

    Route::get('/{kategori}','PagesGetController@haberKategori')->name('kategori-haberler');
    
    Route::get('/{kategori}/{haber}','PagesGetController@haber')->name('haber');



});



// spot bilgilerin routesi gruplandırıldı
Route::group(['prefix' => 'spot'], function () {

    Route::get('','PagesGetController@spotBilgilerAnasayfa')->name('spot-anasayfa');
    
    Route::get('{kategori}','PagesGetController@spotBilgilerDers')->name('spot-dersler');
    
    Route::get('{kategori}/{ders}','PagesGetController@spotBilgiDersKonu')->name('spot-uniteler');
    
    Route::get('{kategori}/{ders}/{unite}','PagesGetController@spotBilgiDersKonuSpotlari')->name('unite-spotlar');

    Route::get('{kategori}/{ders}/{unite}/{spot}','PagesGetController@spotHam')->name('spot');
    


});


// forum route gruplandırıldı
Route::group(['prefix' => 'forum'], function () {


    Route::get('','PagesGetController@forumAnasayfa')->name('forum-anasayfa');
    
    Route::get('/{kategori}', 'PagesGetController@forumKonuKategori')->name('kategori-konular');

    Route::get('/{kategori}/{konu}', 'PagesGetController@forumKonuBireysel')->name('konu');


});

});


//post group belirlenecek   'PagesPostController@spotYorum'


    
    Route::post('/spot','PagesPostController@spotYorum' )->middleware('auth');
    Route::post('/spotBegen','PagesPostController@spotBegeni' )->middleware('auth');

    Route::post('/spotSearch', 'PagesPostController@spotSearch');

    Route::post('/konuSearch', 'PagesPostController@konuSearch');

    Route::post('/forumKonu', 'PagesPostController@konuEkle')->middleware('auth');

    Route::post('/mesajEkle', 'PagesPostController@mesajEkle')->middleware('auth');

    Route::post('/kategoriAvaliable', 'PagesPostController@isKategoriAvaliable');

    Route::post('/kategoriEkle', 'PagesPostController@kategoriEkle')->middleware('auth');
    
    Route::post('/konuBegen', 'PagesPostController@konuBegeni')->middleware('auth');

    Route::post('/iletisimMesaj', 'PagesPostController@iletisimMesaj');

    Route::post('/haberSearch', 'PagesPostController@haberSearch');

    Route::post('/haberYorum','PagesPostController@haberYorum' )->middleware('auth');

    Route::post('/konuMesajBegen', 'PagesPostController@konuMesajBegeni')->middleware('auth');

    
    









    Route::group([],function(){
        Auth::routes();

        // Route::get('/home', 'HomeController@index')->name('home');
      });

  
      


   

// forum route gruplandırıldı
Route::group(['middleware'=>['auth','rol:Admin,Super Admin'],'namespace' => 'admin', 'prefix' => 'admin'], function () {
    
    
    Route::get('anasayfa',function(){
        return view('admin.anasayfa');
    });

    
    Route::group(['middleware' => ['rol:Super Admin']], function () {

    Route::get('sinav','SlaytSinavGetController@sinav')->name('sinavlar');
    Route::post('sinav/editSinav','SlaytSinavPostController@editSinav');
    

 
    Route::get('slayt','SlaytSinavGetController@slayt')->name('slaytlar');
    Route::get('slayt/editSlayt/{slaytId}','SlaytSinavGetController@editSlayt');
    Route::get('slayt/addSlayt','SlaytSinavGetController@addSlayt')->name('addSlayt');



    Route::post('slayt/addSlayt','SlaytSinavPostController@addSlayt')->name('addSlayt');
    Route::post('slayt/editSlayt','SlaytSinavPostController@editSlayt');
    Route::post('slayt/deleteSlayt','SlaytSinavPostController@deleteSlayt');

    Route::get('uyeler', 'uyeler\UyelerGetController@getUyeler')->name('uyeler');
    Route::post('editUye', 'uyeler\UyelerPostController@editUyeler');

        
    });

  




    


    Route::group(['middleware'=>['rol:Haber Editörü,Super Admin'],'prefix' => 'haber'], function () { // gösterme kısmı tamamlandı
        //gösterme yönlendirmeleri yapılıyor
        Route::get('kategoriler','haber\HaberGetController@kategoriler');
        Route::get('yorumlar/{haberId}','haber\HaberGetController@yorumlar');
        Route::get('haberler/{kategoriId}','haber\HaberGetController@haberler');
        Route::get('addHaber/{kategoriId}','haber\HaberGetController@addHaber');
        Route::get('editHaber/{haberId}','haber\HaberGetController@editHaber');
        

 
        Route::post('editKategori','haber\HaberPostController@editKategori');
        Route::post('addKategori','haber\HaberPostController@addKategori');
        Route::post('addHaber','haber\HaberPostController@addHaber');
        Route::post('editHaber','haber\HaberPostController@editHaber');
        Route::post('deleteHaber','haber\HaberPostController@deleteHaber');
    
    });
 
    Route::group(['middleware'=>['rol:Spot Editörü,Super Admin'],'prefix' => 'spot'], function () { // gösterme kısmı tamamlandı

        Route::get('kategoriler','spot\SpotGetController@kategoriler')->name('admin-spot-kategoriler');
        Route::get('dersler/{kategoriId}','spot\SpotGetController@dersler')->name('admin-spot-dersler');
        Route::get('uniteler/{dersId}','spot\SpotGetController@uniteler')->name('admin-spot-uniteler');
        Route::get('spotlar/{uniteId}','spot\SpotGetController@spotlar')->name('admin-spot-spotlar');
        Route::get('yorumlar/{spotId}','spot\SpotGetController@yorumlar')->name('admin-spot-yorumlar');


        Route::get('editKategori/{kategoriId}','spot\SpotGetController@editKategori');//edit kısmı
        Route::get('editDers/{dersId}','spot\SpotGetController@editDers');//edit kısmı
        Route::get('editUnite/{uniteId}','spot\SpotGetController@editUnite');//edit kısmı
        Route::get('editSpot/{spotId}','spot\SpotGetController@editSpot');//edit kısmı
        Route::get('editYorum/{yorumId}','spot\SpotGetController@editYorum');//edit kısmı

        
        Route::post('editSpot','spot\SpotPostController@editSpot');// edit Kısmı yapılıyor
        Route::post('editUnite','spot\SpotPostController@editUnite');// edit Kısmı yapılıyor
        Route::post('editDers','spot\SpotPostController@editDers');// edit Kısmı yapılıyor
        Route::post('editKategori','spot\SpotPostController@editKategori');// edit Kısmı yapılıyor



        Route::get('addKategori','spot\SpotGetController@addKategori');// add Kısmı yapılıyor
        Route::get('addDers/{kategoriId}','spot\SpotGetController@addDers');// add Kısmı yapılıyor
        Route::get('addUnite/{dersId}','spot\SpotGetController@addUnite');// add Kısmı yapılıyor
        Route::get('addSpot/{uniteId}','spot\SpotGetController@addSpot');// add Kısmı yapılıyor
      


        Route::post('addSpot','spot\SpotPostController@addSpot');// add Kısmı yapılıyor
        Route::post('addUnite','spot\SpotPostController@addUnite');// add Kısmı yapılıyor
        Route::post('addDers','spot\SpotPostController@addDers');// add Kısmı yapılıyor
        Route::post('addKategori','spot\SpotPostController@addKategori');// add Kısmı yapılıyor


        Route::post('deleteYorum','spot\SpotPostController@deleteYorum');// delete Kısmı yapılıyor
        Route::post('deleteSpot','spot\SpotPostController@deleteSpot');// delete Kısmı yapılıyor
        Route::post('deleteUnite','spot\SpotPostController@deleteUnite');// delete Kısmı yapılıyor
        Route::post('deleteDers','spot\SpotPostController@deleteDers');// delete Kısmı yapılıyor
        Route::post('deleteKategori','spot\SpotPostController@deleteKategori');// delete Kısmı yapılıyor
       


    
    });

    Route::group(['middleware'=>['rol:Forum Editörü,Super Admin'],'prefix' => 'forum'], function () { // gösterme kısmı tamamlandı

        Route::get('kategoriler','forum\ForumGetController@kategoriler');
        Route::get('konuMesajlar/{konuId}','forum\ForumGetController@konuMesajlar');
        Route::get('konular/{kategoriId}','forum\ForumGetController@konular');

        Route::post('addKategori','forum\ForumPostController@addKategori');
        Route::post('editKategori','forum\ForumPostController@editKategori');
        Route::post('deleteKonu','forum\ForumPostController@deleteKonu');

        Route::post('deleteMessage','forum\ForumPostController@deleteMessage');




    
    });

    

    
    
   


});