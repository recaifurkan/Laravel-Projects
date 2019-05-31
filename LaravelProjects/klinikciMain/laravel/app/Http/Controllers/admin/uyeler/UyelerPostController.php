<?php

namespace App\Http\Controllers\admin\uyeler;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UyelerPostController extends Controller
{
    public function editUyeler(Request $request){
    //   dd($request->all());

        if($request->editUye){
            $uye = User::findOrFail($request->uyeId);
            $uye->uye_isbanlandi = $request->banlandi;

            $uye->roller()->detach();
            if(isset($request->uyeRoller)){

                foreach ($request->uyeRoller as $rol ) {
                    // dd($rol);
                    $uye->roller()->attach($rol);
                }

            }
           
            $sonuc = $uye->update();
            if($sonuc){
                // dd($sonuc);
                return redirect()->back()->with('succes', 'Üye güncellendi');
            }

        }

       
    }
}
