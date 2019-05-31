<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller
{
    public function editKategori(Request $request){
        if(isset($request->submitDuzenle)){// kategori duzenleme işlemler yapılacak
            $validator = Validator::make($request->all(), [
                // 'haberResim' => 'required',
                'kategoriName' => 'required',
                
                'kategoriAciklama' => 'required',
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Kategori::findOrFail($request->kategoriId);
            $kategori->name=$request->kategoriName;
            $kategori->url=permalink($request->kategoriName);
            $kategori->aciklama=$request->kategoriAciklama;
            if($request->ustKategori == 0){
                $kategori->ustKategoriId=$request->ustKategori;
            }
            else{
                $ustKategori = Kategori::findOrFail($request->ustKategori);
                $kategori->getUstKategori()->associate($ustKategori);
            }
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
               
                'kategoriAciklama' => 'required',
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Kategori::findOrFail($request->kategoriId);
            // dd($kategori);
            $altKategoriler = $kategori->altKategoriler;
            // dd($altKategoriler);
            if(isset($altKategoriler)){
                foreach ($altKategoriler as $altKategori ) {
                    $altKategori->delete();
                }
            }
            
            $sonuc = $kategori->delete();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Silindi');
            }

        }

    }
}
