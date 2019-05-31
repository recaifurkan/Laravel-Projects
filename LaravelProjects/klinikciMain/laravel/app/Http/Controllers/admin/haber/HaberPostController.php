<?php

namespace App\Http\Controllers\admin\haber;

use Carbon\Carbon;
use App\Models\Haber;
use App\Models\Resim;
use Illuminate\Http\Request;
use App\Models\Haber_kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HaberPostController extends Controller
{
    public function editKategori(Request $request){
        if(isset($request->submitDuzenle)){// kategori duzenleme işlemler yapılacak
            $validator = Validator::make($request->all(), [
                // 'haberResim' => 'required',
                'kategoriName' => 'required',
                'kategoriUrl' => 'required',
                'kategoriAciklama' => 'required',
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Haber_kategori::findOrFail($request->kategoriId);
            $kategori->name=$request->kategoriName;
            $kategori->url=$request->kategoriUrl;
            $kategori->aciklama=$request->kategoriAciklama;
            $kategori->haber_kategori_id=$request->ustKategori;
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
                'kategoriAciklama' => 'required',
                
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                // dd($validator->errors()->all());
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }
            $kategori = Haber_kategori::findOrFail($request->kategoriId);
            $altKategoriler = $kategori->altKategoriler;
            foreach ($altKategoriler as $altKategori ) {
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
            'kategoriAciklama' => 'required',
            
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            // dd($validator->errors()->all());
            // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
            // dd($request->all());
            $kategori = new Haber_kategori;
            $kategori->name=$request->kategoriName;
            $kategori->url=$request->kategoriUrl;
            $kategori->aciklama=$request->kategoriAciklama;
            $kategori->ustKategoriId=$request->ustKategori;
            $sonuc =  $kategori->save();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Düzenlendi');
            }
       





        

    }

    public function addHaber(Request $request){
       
            
            if(isset($request->haberResimlerSubmit)){
                $validator = Validator::make($request->all(), [
                    // 'dersResim' => 'required',
                    'haberResimler.*' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048'
                    
                ]);
                // dd($validator->errors()->all());
                if($validator->errors()->all()){
                    
                    // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                    return redirect()->back()->with('hatalar', $validator->errors()->all());   
                   
        
                }
 
                $haber = new Haber;
                $haber->baslik = $request->haberBaslik;
                $kategori = Haber_kategori::findOrFail($request->kategoriId);
                $haber->kategori()->associate($kategori);
                $sonucHaber = $haber->save();
                
                // dd($request->all());
            if($request->haberResimler){
                // dd($request->haberResimler);
                $resimler = [];
                foreach ($request->haberResimler as $resim) {
                    $name = permalink($resim->getClientOriginalName());
                    $extension = $resim->getClientOriginalExtension();
                    $fileName = $name.time().'.'.$extension;
                    $destinationPath = public_path('storage/assets/');
                    $databasePath = 'haberler/'.$kategori->name.'/'.$haber->id;   
                    $destinationPath = $destinationPath.$databasePath;
                    $sonuc = $resim->move($destinationPath, $fileName);
                    $databasePath = $databasePath.'/'.$fileName;
                    if($sonuc){
                        $resim = new Resim;
                        $resim->url=$databasePath;
                        // echo $databasePath;
                        
                        $resim->aciklama = $haber->baslik.time();
                        $sonuc = $resim->save();
                        $sonuc = $haber->resimler()->save($resim);
                        array_push($resimler,$resim);

                       
                        // dd($sonuc);
                    }

                }
                if($sonuc){
                    // dd($sonuc);
                    return redirect()->back()->with([
                        'resimler'=> $resimler,
                        'haber'=>$haber]);
                }
            }
            if($sonucHaber){
                // dd($sonuc);
                return redirect()->back()->with([
                    'succes'=> 'Haber Oluşturuldu',
                    'haber'=>$haber
                   
                    ]);

        }
        }

        if($request->haberIcerikSubmit){
            $validator = Validator::make($request->all(), [
                // 'dersResim' => 'required',
                'haberAnaResim' => 'required|image|mimes:jpeg,bmp,png,gif|max:2048'
                
            ]);
            // dd($validator->errors()->all());
            if($validator->errors()->all()){
                
                // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
                return redirect()->back()->with('hatalar', $validator->errors()->all());   
               
    
            }

            $haber = Haber::findOrFail($request->haberId);
            $haber->keywords = $request->haberKeywords;
            $haber->url = $request->haberUrl;
            $haber->icerik = $request->haberIcerik;
            $haber->kisa_aciklama = $request->haberAciklamasi;
            $haber->haberOnay = 1;
            $haber->eklenme_tarihi = Carbon::now();
            $haber->user()->associate(Auth::user());
            $haber->save();
            $resim = $request->haberAnaResim;
            $name = permalink($resim->getClientOriginalName());
                    $extension = $resim->getClientOriginalExtension();
                    $fileName = $name.time().'.'.$extension;
                    $destinationPath = public_path('storage/assets/');
                    $databasePath = 'haberler/'.$haber->kategori->name.'/'.$haber->id;   
                    $destinationPath = $destinationPath.$databasePath;
                    $sonuc = $resim->move($destinationPath, $fileName);
                    $databasePath = $databasePath.'/'.$fileName;
                    if($sonuc){
                        $resim = new Resim;
                        $resim->url=$databasePath;
                        // echo $databasePath;
                        
                        $resim->aciklama = $haber->baslik.time();
                        $sonuc = $resim->save();
                        $sonuc = $haber->kapakResim()->save($resim);
                        // array_push($resimler,$resim);
                        if($sonuc){
                            return redirect()->back()->with('succes', 'Haber Eklendi');
                        }

                       
                        // dd($sonuc);
                    }



            dd($request->all());
        }



        // dd($request->all());

        return $request->all();




    }

    public function editHaber(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'haberResim' => 'required',
            'haberAnaResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048'
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
        $haber = Haber::findOrFail($request->haberId);
        $haber->keywords = $request->haberKeywords;
        $haber->url = $request->haberUrl;
        $haber->icerik = $request->haberIcerik;
        $haber->kisa_aciklama = $request->haberAciklamasi;
        if(isset( $request->haberAnaResim)){
           
            if(isset($haber->kapakResim)){
                $haberKapakResim = $haber->kapakResim;
                $dersResimPath = public_path('storage/assets').'/'.$haberKapakResim->url;
                $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $resim = $haberKapakResim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
        $resim =  $request->haberAnaResim;
        $name = permalink($resim->getClientOriginalName());
        $extension = $resim->getClientOriginalExtension();
        
        
        $fileName = $name.time().'.'.$extension;
        

        $destinationPath = public_path('storage/assets/');
        $databasePath = 'haberler/'.$haber->kategori->name.'/'.$haber->id;   
        $destinationPath = $destinationPath.$databasePath;
        $sonuc = $resim->move($destinationPath, $fileName);
        $databasePath = $databasePath.'/'.$fileName;
        if($sonuc){
            $resim = new Resim;
            $resim->url=$databasePath;
            $resim->aciklama = $haber->baslik;
            $sonuc = $resim->save();
            $haber->kapakResim()->save($resim);
            
            // dd($sonuc);
        }
          
        }
        $sonuc = $haber->update();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Haber güncellendi');
        }
        

        // dd($request->all());

        return $request->all();

    }

    public function deleteHaber(Request $request){
        $haber= Haber::findOrFail($request->haberId);
        $resimler = $haber->resimler;
        if(isset($haber->kapakResim)){
            $resimler->add($haber->kapakResim);
        }
      
       
        // dd($resimler);
        foreach ($resimler as $resim ) {
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets').'/'.$resim->url;
                $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
        }
        $sonuc = $haber->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Haber Silindi');
        }
    }
}
