<?php

namespace App\Http\Controllers\admin\uyeler;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UyelerGetController extends Controller
{
   public function getUyeler(){
       $uyeler = User::paginate(10);
       $roller = Role::all();

       return view('admin.kullanicilar.kullanicilar')->with([
           'uyeler'=>$uyeler,
           'roller'=>$roller
       ]);
   }
}
