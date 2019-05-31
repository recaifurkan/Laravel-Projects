<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Spot;
use App\Models\Haber;
use App\Models\Sinav;
use App\Models\IpAdress;
use App\Models\Uye_resim;
use App\Models\Forum_konu;
use App\Models\Spot_yorum;
use App\Models\Haber_yorum;
use Illuminate\Http\Request;
use App\Models\IletisimMesaj;
use App\Models\Forum_konu_mesaj;

use App\Models\Forum_konu_kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PagesPostController extends PageController
{
     
     public function spotYorum(Request $request){

       
        if($request->spotYorum){
            
            Validator::make($request->all(), [
                'yorumText' => 'required|max:400',
            ]);

            $spotYorum = new Spot_yorum;
            $spotYorum->icerik=$request->yorumText;
            $spotYorum->spotlar_id = $request->spotid;
            $spotYorum->user_id = Auth::user()->id;
            $spotYorum->eklenme_tarih = Carbon::now();
            $spotYorum->save();
            
           
            return back();
        }

        
        
        
        
        if($request->altYorum){
            
            Validator::make($request->all(), [
                'altYorumText' => 'required|max:400',
            ]);
            $spotYorum = new Spot_yorum;
            $spotYorum->icerik=$request->altYorumText;
            $spotYorum->ust_yorum_id = $request->ustYorum;
            $spotYorum->user_id = Auth::user()->id;
            $spotYorum->eklenme_tarih = Carbon::now();
            $spotYorum->save();
            
           
            return back();
        }
        

        return 'false';
    }

    public function spotSearch(Request $request){
        if($request->searchText){
            $spotAdet = 0;
           $searchSpots =  Spot::where('icerik', $request->searchText)
            ->orWhere('icerik', 'like', '%' . $request->searchText . '%')->limit(6)->get();
           
                return $searchSpots->toJson();
        }

    }

    public function spotBegeni(Request $request){
       
       
        $spot = Spot::where('id',$request->spotId)->first();
        foreach ($spot->likedUsers as $user) {
            if($user->id==Auth::user()->id)
            return 'zaten beğenmiş ';
           
        }
       
            $spot->likedUsers()->attach(Auth::user()->id);
           
            $spot->like +=1;
            $spot->save();
       
       
        if($spot){
            return $spot;
        }

        return 'sikinti var'; 
    }


    public function konuSearch(Request $request){
        if($request->searchText){
            
           $searchSpots =  Forum_konu::where('aciklama', $request->searchText)
            ->orWhere('aciklama', 'like', '%' . $request->searchText . '%')->limit(6)->get();
           
                return $searchSpots->toJson();
        }

    }

    public function konuEkle(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:forum_konus|max:50',
            'konuIcerik' => 'min:15|required|max:2000',
           
        ]);
        // dd('recai'); 


        if($validator->errors()->all()){
            return response($validator->errors()->all(),500);

        }
        else{
            $newKonu = new Forum_konu;
            $newKonu->name = htmlspecialchars($request->name) ;
            $newKonu->url = permalink(htmlspecialchars_decode($request->name));
            $decodeli =  $request->konuIcerik;
            $newKonu->keywords=str_replace(" ", ",", htmlspecialchars_decode($request->konuIcerik));
            $newKonu->acilis_tarihi=Carbon::now();
            $newKonu->aciklama = $decodeli ;
            $newKonu->forum_konular_kategoriler_id=$request->kategori;
            $newKonu->user_id=Auth::user()->id;
            $newKonu->save();
            if($newKonu){
                return response('okey',200);
            }


        }
        
        // dd($request->all());
        // return $request->all();

    }

    public function mesajEkle(Request $request){
        $validator = Validator::make($request->all(), [
           'mesajIcerik' => 'min:15|required|max:400',
        ]);
        if($validator->errors()->all()){
            return response($validator->errors()->all(),500);

        }
        else{
            $newKonu = new Forum_konu_mesaj;
          
           
            $newKonu->yazilma_tarihi=Carbon::now();
            $newKonu->icerik = $request->mesajIcerik;
            $newKonu->forum_konular_id=$request->konuid;
            $newKonu->user_id=Auth::user()->id;
            $newKonu->save();
            if($newKonu){
                return response('okey',200);
            }


        }
        
        // dd($request->all());
        // return $request->all();

    }

    public function isKategoriAvaliable(Request $request){
        $kategoriad = $request->kategori_ad;
        $forumKategori =  Forum_konu_kategori::where('name', $kategoriad)
        ->orWhere('name', 'like', '%' . $kategoriad . '%')->limit(6)->get();
        if($forumKategori){
            return response($forumKategori,200);
        }
        return response(false,200);

    }

    public function kategoriEkle(Request $request){
      
        $newKategori = new Forum_konu_kategori;
        $newKategori->name = $request->kategori_ad;
        $newKategori->url=  permalink($request->ad);
        $newKategori->save();

        if($newKategori){
            return $newKategori->toJson();
        }

        return false;

    }

    public function konuBegeni(Request $request){
       
       
        $konu = Forum_konu::where('id',$request->konuId)->first();
        foreach ($konu->likedUsers as $user) {
            if($user->id==Auth::user()->id){
            //    dd($user->id==Auth::user()->id);
                return 'zaten beğenmiş ';
            }
           
           
        }
       
            $konu->likedUsers()->attach(Auth::user()->id);
           
            $konu->begenilme_sayisi +=1;
            $konu->save();
       
       
        if($konu){
            return $konu;
        }

        return 'sikinti var'; 
    }

    public function konuMesajBegeni(Request $request){
       
       
        $mesaj = Forum_konu_mesaj::where('id',$request->mesajId)->first();
        foreach ($mesaj->likedUsers as $user) {
            if($user->id==Auth::user()->id){
            //    dd($user->id==Auth::user()->id);
                return 'zaten beğenmiş ';
            }
           
           
        }
       
            $mesaj->likedUsers()->attach(Auth::user()->id);
           
            $mesaj->begeni +=1;
            $mesaj->save();
       
       
        if($mesaj){
            return $mesaj;
        }

        return 'sikinti var'; 
    }

    public function iletisimMesaj(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'min:2|required|max:40',
            'email' => 'min:2|required|max:100',
            'konu' => 'min:2|required|max:40',
            'mesaj' => 'min:10|required|max:500',
         ]);
         if($validator->errors()->all()){
             return Redirect::to(route('iletisim'))->with('errors', $validator->errors()->all());
 
         }
         $response = [];
         $ipadress = new IpAdress;
         $ipadress->ip($request->ip());
         
         if($ipadress->isCacheIpBakti()){
             $text = 'Lütfen 5 dakika sonra tekrar deneyiniz...';
             $response['error'] = $text;
            return view('iletisim')->with('response', $response);
         }
         else{
            $newMesaj = new IletisimMesaj;
            $newMesaj->isim = $request->name; 
            $newMesaj->email =$request->email;
            $newMesaj->konu = $request->konu;
            $newMesaj->mesaj = $request->mesaj;
            $sonuc = $newMesaj->save();
            $ipadress->ipCacheEkle();
            if($sonuc){
               $text = 'Merhaba! "'.$newMesaj->isim. '" mesajınız bize başarıyla  ulaşmıştır. En kısa sürede geri dönüş "'.$newMesaj->email.'" e-mail adresinize yapılacaktır.Esenlikle...';
                $response['succes']= $text;
               return view('iletisim')->with('response', $response);
            }

         }

        
       


    }

    public function haberSearch(Request $request){
        if($request->searchText){
            
           $searchSpots =  Haber::where('icerik', $request->searchText)->orwhere('baslik', 'like', '%' . $request->searchText . '%')
            ->orWhere('icerik', 'like', '%' . $request->searchText . '%')->limit(6)->get();
           
                return $searchSpots->toJson();
        }

    }

    public function haberYorum(Request $request){

       
        if($request->haberYorum){
            
            Validator::make($request->all(), [
                'yorumText' => 'required|max:400',
            ]);

            $haberYorum = new Haber_yorum;
            $haberYorum->icerik=$request->yorumText;
            $haberYorum->haber_id = $request->haberid;
            $haberYorum->user_id = Auth::user()->id;
            $haberYorum->yorum_tarihi = Carbon::now();
            $haberYorum->save();
            
           
            return back();
        }

        
         
        
        
        if($request->altYorum){
            
            Validator::make($request->all(), [
                'altYorumText' => 'required|max:400',
            ]);
            $haberYorum = new Haber_yorum;
            $haberYorum->icerik=$request->altYorumText;
            $haberYorum->ust_yorum_id = $request->ustYorum;
            $haberYorum->user_id = Auth::user()->id;
            $haberYorum->yorum_tarihi = Carbon::now();
            $haberYorum->save();
            
           
            return back();
        }
        

        return 'false';
    }

    public function editProfil(Request $request){
        $rules = [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required',
            'email' => 'required|email',
             'profilImage' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
             'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|same:password|min:6'
        ];
        $uye = Auth::user();
        if($uye->kullanici_adi != $request->kullaniciAdi){

            $rules['kullaniciAdi'] = 'max:40|required|unique:users,kullanici_adi';

        }
       

        $messages = [
            'email.required' => 'Lütfen Emailinizi giriniz',
            'first_name.required' => 'Lütfen İsminizi giriniz',
            'last_name.required' => 'Lütfen soyadınızı giriniz',
            'password.min' => 'Şifreniz en az 6 karakter olmalıdır',
            'password_confirmation.min' => 'Şifre onayınız en az 6 karakter olmalıdır',
            'kullaniciAdi.unique'=>'Maalesef kullanıcı adı bir başkası tarafından alınmış'
        ];

        $validator =  Validator::make($request->all(),$rules ,$messages);

        // dd($request->all());
        if($validator->errors()->all()){
          
            // dd($validator->errors()->all());
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
       
        $uye->name = $request->first_name;
        $uye->email = $request->email;
        if($request->password){
            $uye->password = Hash::make($request->password);
         }
        $uye->soyad = $request->last_name;
        $uye->kullanici_adi = $request->kullaniciAdi;
        $sinav = Sinav::findOrFail($request->uyeSinav);
        $uye->sinav()->associate($sinav);
        
        // $uye->sinav()->attach();
      
        // dd($uye->sinav);

        if($resim =  $request->profilImage){
            // dd($uye->profilResim);
            if(isset($uye->profilResim)){
                Storage::delete($uye->profilResim->url);
                $oldResim = $uye->profilResim;
                $sonuc = $oldResim->delete();
                // dd($sonuc);

            }
            $extension = $resim->getClientOriginalExtension();
            $uyeId = Auth::user()->id;
            $filePath = 'uyeler/'.$uyeId;
            $fileName = 'user'.$uye->id.'.'.$extension;
            // dd($fileName);
            $resim->storeAs($filePath,$fileName );
            $databasePath = $filePath . '/'. $fileName;
            $profilImage = new Uye_resim;
            $profilImage->url = $databasePath;
           
            $sonuc =$profilImage->uye()->associate($uye);
            $profilImage->save();
            
            // dd($sonuc);


        }
        // dd($request->all());
        $sonuc = $uye->update();
        if($sonuc){
            return redirect()->back()->with('succes', 'Profiliniz Güncellendi');
        }
       

        

        // return 'recai';
    }

    
}
