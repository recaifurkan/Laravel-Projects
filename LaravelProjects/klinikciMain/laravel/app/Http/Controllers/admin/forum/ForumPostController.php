<?php

namespace App\Http\Controllers\admin\forum;

use App\Models\Forum_konu;
use Illuminate\Http\Request;
use App\Models\Forum_konu_mesaj;
use App\Models\Forum_konu_kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ForumPostController extends Controller
{
    public function editKategori(Request $request){
        if(isset($request->submitDuzenle)){// kategori duzenleme işlemler yapılacak
            $validator = Validator::make($request->all(), [
                // 'haberResim' => 'required',
                'kategoriName' => 'required',
                'kategoriUrl' => 'required',
              
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Forum_konu_kategori::findOrFail($request->kategoriId);
            $kategori->name=$request->kategoriName;
            $kategori->url=$request->kategoriUrl;
           
            $kategori->ustkategori_id=$request->ustKategori;
            $sonuc =  $kategori->update();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Düzenlendi');
            }
        }





        if(isset($request->submitDelete)){
            // return 'delete';
            $validator = Validator::make($request->all(), [
                // 'haberResim' => 'required',
                'kategoriName' => 'required',
                'kategoriUrl' => 'required',
              
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Forum_konu_kategori::findOrFail($request->kategoriId);
            $kategoriKonular = $kategori->konular;
            foreach($kategoriKonular as $konu){
                $konuMesajlari = $konu->mesajlar;
                foreach ($konuMesajlari as $mesaj ) {
                    $mesaj->delete();
                }
                $konu->delete(); 
            }
            $altKategoriler = $kategori->altKategoriler;
            foreach ($altKategoriler as $altKategori ) {
                $altKategoriKonulari = $altKategori->konular;
                foreach ($altKategoriKonulari as $konu ) {
                    $konuMesajlari = $konu->mesajlar;
                    foreach ($konuMesajlari as $mesaj ) {
                        $mesaj->delete();
                    }
                    $konu->delete();
                }
                
                $altKategori->delete();
            }
            $sonuc = $kategori->delete();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Silindi');
            }

        }

    }

    public function addKategori(Request $request){
        $validator = Validator::make($request->all(), [
            // 'haberResim' => 'required',
            'kategoriName' => 'required',
            'kategoriUrl' => 'required',
         
            
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            // dd($validator->errors()->all());
            // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
            // dd($request->all());
            $kategori = new Forum_konu_kategori;
            $kategori->name=$request->kategoriName;
            $kategori->url=$request->kategoriUrl;
         
            $kategori->ustkategori_id=$request->ustKategori;
            $sonuc =  $kategori->save();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Eklendi');
            }
       

        

    }

    public function deleteKonu(Request $request){
        $konu = Forum_konu::findOrFail($request->konuId);
        $konuMesajlari = $konu->mesajlar;
        foreach ($konuMesajlari as $mesaj ) {
            $mesaj->delete();

        }
        $sonuc =$konu->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Kategori Silindi');
        }
    }

    public function deleteMessage(Request $request){
        $mesaj = Forum_konu_mesaj::findOrFail($request->mesajId);
        $sonuc = $mesaj->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Mesaj Silindi');
        }


    }
}
