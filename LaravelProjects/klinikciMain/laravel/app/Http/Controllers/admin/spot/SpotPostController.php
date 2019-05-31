<?php

namespace App\Http\Controllers\admin\spot;


use Carbon\Carbon;
use App\Models\Spot;
use App\Models\Resim;



use App\Models\Spot_ders;
use App\Models\Spot_unite;
use App\Models\Spot_yorum;

use Illuminate\Http\Request;
use App\Models\Spot_kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SpotPostController extends Controller
{
    public function editSpot(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'spotResim.*' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048'
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
        $spot= Spot::findOrFail($request->spotId);
      
        // dd($spot);
        $spot->icerik = $request->spotIcerik;
        $spot->url = $request->spotUrl;
        $spot->keywords=$request->spotKeywords;
        if(isset($request->spotResim)){
            if($spot->resimler->count()>0){

                foreach ($spot->resimler as $resim ) {
                    $spotResimPath = public_path('storage/assets/').$resim->url;
                    // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                    // dd(File::exists($spotResimPath));
                    if (File::exists($spotResimPath)) {
                       
                        $sonuc = File::delete($spotResimPath);
                        $sonuc = $resim->delete(); 
                        // dd($sonusc);
                       
                    }
                }

               

            }

            foreach($request->spotResim as $resim){

                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
               
               
                $fileName = $name.time().'.'.$extension;
              
    
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/spotlar/'.$spot->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $spot->icerik;
                    $sonuc = $resim->save();
                    $spot->resimler()->save($resim);
                   
                    // dd($sonuc);
                }
            }
        }
        $sonuc = $spot->update();
        // dd($spot);
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Spot güncellendi');
        }
        

        // dd($request->all());

        return $request->all();

    }

    public function editUnite(Request $request){
        $unite = Spot_unite::findOrFail($request->uniteId);
        // dd($unite);
        $unite->name=$request->uniteIsim;
        $unite->aciklama=$request->uniteAciklama;
        $unite->url=$request->uniteUrl;
        $sonuc = $unite->update();
        if($sonuc){
            return redirect()->back()->with('succes', 'Ünite güncellendi');
        }

        return $request->all();
    }

    public function editDers(Request $request){
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'dersResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
       
        $ders = Spot_ders::findOrFail($request->dersId);
        // dd($ders);
        $ders->name=$request->dersIsim;
        $ders->aciklama=$request->dersAciklama;
        $ders->url=$request->dersUrl;
        if(isset($request->dersResim)){
           
            if(isset($ders->resim)){
                $dersResimPath = public_path('storage/assets/').$ders->resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $resim = $ders->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->dersResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/dersler/'.$ders->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $ders->name;
                    $sonuc = $resim->save();
                    $ders->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
        $sonuc = $ders->update();
        if($sonuc){
            return redirect()->back()->with('succes', 'Ders güncellendi');
        }

        return $request->all();
    }

    public function editKategori(Request $request){
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'kategoriResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
    //    dd($request->all());
        
        $kategori = Spot_kategori::findOrFail($request->kategoriId);
        // dd($ders);
        $kategori->name=$request->kategoriIsim;
        $kategori->keywords=$request->kategoriKeywords;
        $kategori->url=$request->kategoriUrl;
        if(isset($request->kategoriResim)){ // eğer resim varsa validator yapılıyor
            
           
           
            if(isset($kategori->resim)){
                $kategoriResimPath = public_path('storage/assets/').$kategori->resim->url;
                // $kategoriResimPath = str_replace("/","\\" ,$kategoriResimPath);
                if (File::exists($kategoriResimPath)) {
                   
                    $sonuc = File::delete($kategoriResimPath);
                    $resim = $kategori->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->kategoriResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/kategoriler/'.$kategori->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $kategori->name;
                    $sonuc = $resim->save();
                    $kategori->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
        $sonuc = $kategori->update();
        if($sonuc){
            return redirect()->back()->with('succes', 'Kategori güncellendi');
        }

        return $request->all();


    }

    public function addKategori(Request $request){
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'kategoriResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
    //    dd($request->all());
        
        $kategori = new Spot_kategori;
        // dd($ders);
        $kategori->name=$request->kategoriIsim;
        $kategori->keywords=$request->kategoriKeywords;
        $kategori->url=$request->kategoriUrl;
        if(isset($request->kategoriResim)){ // eğer resim varsa validator yapılıyor
            
           
           
            if(isset($kategori->resim)){
                $kategoriResimPath = public_path('storage/assets/').$kategori->resim->url;
                // $kategoriResimPath = str_replace("/","\\" ,$kategoriResimPath);
                if (File::exists($kategoriResimPath)) {
                   
                    $sonuc = File::delete($kategoriResimPath);
                    $resim = $kategori->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->kategoriResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/kategoriler/'.$kategori->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $kategori->name;
                    $sonuc = $resim->save();
                    $kategori->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
        $sonuc = $kategori->save();
        if($sonuc){
            return redirect()->back()->with('succes', 'Kategori güncellendi');
        }

        return $request->all();


    }

    public function addDers(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'dersResim' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048',
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
       
        $ders = new Spot_ders;
        // dd($ders);
        $ders->name=$request->dersIsim;
        $ders->aciklama=$request->dersAciklama;
        $ders->url=$request->dersUrl;
        $kategori = Spot_kategori::findOrFail($request->kategoriId);
       
        $ders->kategori()->associate($kategori);//spot_kategoriler_id=$kategori->id;
        $sonuc = $ders->save();
        
        
        if(isset($request->dersResim)){
           
            if(isset($ders->resim)){
                $dersResimPath = public_path('storage/assets/').$ders->resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $resim = $ders->resim;
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
            
               

                // dd($sonuc);
                $resim = $request->dersResim; // resim alındı
                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
                $fileName = $name.time().'.'.$extension; // benzersiz isim yapıldı
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/dersler/'.$ders->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $ders->name;
                    $sonuc = $resim->save();
                    $ders->resim()->save($resim);
                   
                    // dd($sonuc);
                }
          
        }
        
      
       
        

        if($sonuc){
            return redirect()->back()->with('succes', 'Ders Eklendi');
        }

        return $request->all();
    }

    public function addUnite(Request $request){
        $unite = new Spot_unite;
        // dd($unite);
        $unite->name=$request->uniteIsim;
        $unite->aciklama=$request->uniteAciklama;
        $unite->url=$request->uniteUrl;
        $unite->eklenme_tarihi=Carbon::now();
        $ders=Spot_ders::findOrFail($request->dersId);
        $unite->ders()->associate($ders);
        $sonuc = $unite->save();
        if($sonuc){
            return redirect()->back()->with('succes', 'Ünite Eklendi');
        }

        return $request->all();
    }

    public function addSpot(Request $request){
        $validator = Validator::make($request->all(), [
            // 'spotResim' => 'required',
            'spotResim.*' => 'sometimes|image|mimes:jpeg,bmp,png,gif|max:2048'
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.spotlar.spot-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
        $spot= new Spot;
      
        // dd($spot);
        $spot->icerik = $request->spotIcerik;
        $spot->url = $request->spotUrl;
        $spot->keywords=$request->spotKeywords;
        $unite = Spot_unite::findOrFail($request->uniteId);
        $spot->unite()->associate($unite);
        $spot->user()->associate(Auth::user());
        $sonuc = $spot->save();
        if(isset($request->spotResim)){
            foreach($request->spotResim as $resim){

                $name = permalink($resim->getClientOriginalName());
                $extension = $resim->getClientOriginalExtension();
               
               
                $fileName = $name.time().'.'.$extension;
              
    
                $destinationPath = public_path('storage/assets/');
                $databasePath = 'spotlar/spotlar/'.$spot->id;   
                $destinationPath = $destinationPath.$databasePath;
                $sonuc = $resim->move($destinationPath, $fileName);
                $databasePath = $databasePath.'/'.$fileName;
                if($sonuc){
                    $resim = new Resim;
                    $resim->url=$databasePath;
                    $resim->aciklama = $spot->icerik;
                    $sonuc = $resim->save();
                    $spot->resimler()->save($resim);
                   
                    // dd($sonuc);
                }
            }
        }
       
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Spot Eklendi');
        }
        

        // dd($request->all());

        return $request->all();

    }
    public function deleteYorum(Request $request){
        $yorum = Spot_yorum::findOrFail($request->yorumId);
          
        $sonuc = $yorum->delete();
        $altYorumlar = $yorum->altYorumlar->all();
        foreach ($altYorumlar as $altYorum ) {
            $altYorum->delete();
        }
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Yorum Silindi');
        }
    }

    public function deleteSpot(Request $request){
        // dd($request->all());
        $spot = Spot::findOrFail($request->spotId);
        $resimler = $spot->resimler;
        foreach ($resimler as $resim ) {
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets/').$resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
        }
       
        $spotYorumlar =  $spot->yorumlar->all();
        foreach ($spotYorumlar as $spotYorum) {
            $spotAltYorumlar = $spotYorum->altYorumlar->all();
            foreach ($spotAltYorumlar as $altYorum ) {
                $altYorum->delete();
            }
            $spotYorum->delete();
        }
        $sonuc = $spot->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Spot Silindi');
        }
    }

    public function deleteUnite(Request $request){
        $unite = Spot_unite::findOrFail($request->uniteId);
        $resim = $unite->resim;
      
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets/').$resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
     
        $sonuc = $unite->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Ünite Silindi');
        }
    }

    public function deleteDers(Request $request){
        $ders = Spot_ders::findOrFail($request->dersId);
        $resim = $ders->resim;
      
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets/').$resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
     
        $sonuc = $ders->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Ders Silindi');
        }
        
    }

    public function deleteKategori(Request $request){
        $kategori = Spot_kategori::findOrFail($request->kategoriId);
        $resim = $kategori->resim;
      
            if(isset($resim)){
                $dersResimPath = public_path('storage/assets/').$resim->url;
                // $dersResimPath = str_replace("/","\\" ,$dersResimPath);
                if (File::exists($dersResimPath)) {
                   
                    $sonuc = File::delete($dersResimPath);
                    $sonuc = $resim->delete();
                    // dd($sonuc);
                   
                }

            }
     
        $sonuc = $kategori->delete();
        if($sonuc){
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Kategori Silindi');
        }
        
    }
}
