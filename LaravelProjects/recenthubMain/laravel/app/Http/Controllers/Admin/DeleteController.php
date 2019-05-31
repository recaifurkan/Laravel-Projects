<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Haber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteController extends Controller
{
    public function deleteHaber(Request $request)
    {
        $haber = Haber::findOrFail($request->haberId);
        $resimler = $haber->getAllResim();
        if (isset($resimler)) {
            // dd($resimler);
            foreach ($resimler as $resim) {
                if (isset($resim)) {
                    $dersResimFullPath = public_path('storage/assets') . '/' . $resim->url;
                    $dersResimFullPath = str_replace("\\", "/", $dersResimFullPath);

                    // Burada resimlerin klasörü alındı
                    $pathArray = explode('/',$dersResimFullPath,-1);
                    $path = implode('/',$pathArray);
                    // dd($path);
                    // dd($dersResimFullPath);
                    // dd(File::exists($dersResimFullPath)); 
                    if (File::exists($dersResimFullPath)) {

                        $sonuc = File::delete($dersResimFullPath);
                        // dd($sonuc);
                        $sonuc = $resim->delete();

                        // dd($sonuc);

                    }

                }
            }
        }
        File::deleteDirectory($path);
        $sonuc = $haber->delete();
        if ($sonuc) {
            // dd($sonuc);
            return redirect()->back()->with('succes', 'Haber Silindi');
        }
    }
}
