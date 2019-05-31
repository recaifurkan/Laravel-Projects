<?php 

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Haber;
use App\Models\Resim;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    public function addKategori(Request $request){
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
            // dd($request->all());
            $kategori = new Kategori;
            // dd($request->kategoriName);
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
           
            
            $sonuc =  $kategori->save();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Kategori Düzenlendi');
            }
       
    }
   
    public function addHaber(Request $request){
       
        $validator = Validator::make($request->all(), [
            // 'dersResim' => 'required',
            'haberAnaResim' => 'required|image|mimes:jpeg,bmp,png,gif'  
            
        ]);
        // dd($validator->errors()->all());
        if($validator->errors()->all()){
            
            // return view('admin.haberlar.haber-duzenle')->with('hatalar',  $validator->errors()->all());
            return redirect()->back()->with('hatalar', $validator->errors()->all());   
           

        }
     
           

            $haber = new Haber;
            $haber->baslik = $request->haberBaslik;
            $kategori = Kategori::findOrFail($request->kategoriId);
            $haber->getKategori()->associate($kategori);
           
            
            // dd($request->all());

        $haberAciklama = permalink($request->haberAciklamasi);
        $haberAciklama = str_replace('-',',',$haberAciklama);
        // dd($haberAciklama);
        $haber->anahtarKelimeler = $haberAciklama;
        $haber->url = permalink($request->haberBaslik);
        $haber->icerik = $request->haberIcerik;
        $haber->kisaAciklama = $request->haberAciklamasi;
        if($request->eklenmeTarihi > Carbon::now())
        {
            $eklenmeTarihi = $request->eklenmeTarihi;
        }
        else{
            $eklenmeTarihi = Carbon::now();
        }
        

        // dd(Carbon::now());
        // dd($eklenmeTarihi);
       
        $haber->eklenmeTarihi = $eklenmeTarihi;
        // dd($eklenmeTarihi);
        $haber->getYazar()->associate(Auth::user());
        $haber->save();
   
        $resim = $request->haberAnaResim;
        $name = permalink($resim->getClientOriginalName());
        // dd($name);
        $extension = $resim->getClientOriginalExtension();
               
        $destinationPath = public_path('storage/assets/');
                // dd($destinationPath);
        $databasePath = 'haberler/'.permalink($haber->getKategori->name).'/'.$haber->id.'/';   
        $destinationPath = $destinationPath.$databasePath;
                
            // Burada artık resmmin farklı boyutlarını alacaz
        $image_resize = Image::make($resim->getRealPath());
            // $destinationPath = str_replace('\\','/',$destinationPath);  
          $imageSizes = [
            [550,330],[390,240],[300,215],[112,112],[75,75]
          ];
            if(!File::exists($destinationPath))File::makeDirectory($destinationPath,0755,true);;    
            // dd($destinationPath); 
            // dd($imageSizes);   
            $tempDatabasePath = $databasePath;
            foreach ($imageSizes as $imageSize) {
            //    dd($imageSize[0].'x'.$imageSize[1]);
                $fileName = $imageSize[0].'x'.$imageSize[1].$name.time().'.'.$extension;
            
               $image_resize->resize($imageSize[0], $imageSize[1]);
               $image_resize->save($destinationPath .$fileName);
            //    dd($image_resize);

              // $sonuc = $resim->move($destinationPath, $fileName);
              $databasePath = $tempDatabasePath.$fileName;
            //   echo $databasePath.'<br>';
              // dd($sonuc);
              // resmi servera kayıt tamamlandı

                // aşağıdaki if başlangıcı
            //   if($sonuc){
                  $resim = new Resim;
                  $resim->url=$databasePath;
                  // echo $databasePath;
                  $resim->width=$imageSize[0];
                  $resim->height = $imageSize[1];
                  
                  $resim->aciklama = $haber->baslik;
                //   $sonuc = $resim->getHaber()->save($haber);
                  $sonuc = $resim->save();
                  $sonuc = $haber->getResim($imageSize[0].'x'.$imageSize[1],true)->associate($resim);
                  $sonuc = $haber->update();
                
              
            }   
            
                if($sonuc){
                      return redirect()->back()->with('succes', 'Haber Eklendi');
                  }

                 
                  dd($sonuc);
             
            //   if bitişi
            
            

        dd($request->all());
  



    // dd($request->all());

    return $request->all();




}
}
