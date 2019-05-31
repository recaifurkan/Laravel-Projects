<?php

namespace App\Http\Controllers\admin;

use App\Models\Resim;
use App\Models\Sinav;
use App\Models\Slayt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SlaytSinavPostController extends Controller
{
    public function editSinav(Request $request){
        $sinav = Sinav::findOrFail($request->sinavId);
        // $sinav->sinav_tur = $request->
        // dd($request->sinavTarih);
        $sinav->sinav_tarih = $request->sinavTarih;
        $sonuc = $sinav->update();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Başarıyla Düzenlendi');
        }
        
    }

    public function addSlayt(Request $request){
        // dd($request->all());

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'slaytResim' => 'required|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
       
        $slayt = new Slayt;
        // dd($ders);
        $slayt->sira=$request->slaytSira;
        $slayt->linkUrl = $request->slaytLinkUrl;
        if(isset($request->slaytIsAktif)){
            $slayt->isaktif=1;
        }
        else{
            $slayt->isaktif=0;
        }
       
        $sonuc = $slayt->save();
        
        
        if(isset($request->slaytResim)){
           
            if(isset($slayt->resim)){
                $dersResimPath = public_path('storage/assets/').$slayt->resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $resim = $slayt->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->slaytResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'slaytlar/'.$slayt->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $slayt->id;
                    $sonuc = $resim->save();
                    $slayt->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
      
       
        

        if($sonuc){
            return redirect()->back()->with('succes', 'Slayt Eklendi');
        }

        return $request->all();

    }

    public function editSlayt(Request $request){

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'slaytResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            // dd($validator->errors()->all());
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
       
        $slayt = Slayt::findOrFail($request->slaytId);
        $slayt->linkUrl = $request->slaytLinkUrl;
        // dd($slayt);
        $slayt->sira=$request->slaytSira;
        if(isset($request->slaytIsAktif)){
            // dd(isset($request->slaytIsAktif));
            $slayt->isaktif=1;
        }
        else{
            $slayt->isaktif=0;
        }
       
       
        if(isset($request->slaytResim)){
           
            if(isset($slayt->resim)){
                $dersResimPath = public_path('storage/assets/').$slayt->resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $resim = $slayt->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->slaytResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'slaytlar/'.$slayt->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                // dd($sonuc);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $slayt->id;
                    $sonuc = $resim->save();
                    $slayt->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
        $sonuc = $slayt->update();
        // dd($slayt);
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Slayt güncellendi');
        }

        return $request->all();
    }

    public function deleteSlayt(Request $request){
        // dd($request->all());
        $slayt = Slayt::findOrFail($request->slaytId);
        $resim = $slayt->resim;
        // dd($resim);
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets/').$resim->url;
                // // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                // dd(file_exists($dersResimPath));
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
     
        $sonuc = $slayt->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Slayt Silindi');
        }
    }
}
