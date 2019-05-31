<?php

namespace App\Http\Controllers\admin;

use App\Models\Sinav;
use App\Models\Slayt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlaytSinavGetController extends Controller
{
    public function slayt(){
        // return 'recai';
        $slaytlar = Slayt::all();
        
        return view('admin.slayt.slayt-anasayfa',[
            'slaytlar'=>$slaytlar
        ]);
    }

    public function addSlayt(){
        // return 'recai';
       
        return view('admin.slayt.slayt-ekle');
    }

    public function sinav(){
        $sinavlar = Sinav::all();
        return view('admin.sinavlar.sinav-anasayfa',[
            'sinavlar'=>$sinavlar 
        ]);
    }

    public function editSlayt($editSlayt){
        // dd($editSlayt);
        $slayt = Slayt::findOrFail($editSlayt);

        return view('admin.slayt.slayt-duzenle',[
            'slayt'=>$slayt
        ]);
    }
}
